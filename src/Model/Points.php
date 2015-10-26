<?php
namespace ProjectRena\Model;

use ProjectRena\RenaApp;

/**
 * Calculates points for a killmail
 */
class Points
{

    /**
     * The Slim Application
     */
    private $app;

    /**
     * The Cache
     */
    private $cache;

    /**
     * The baseConfig (config/config.php)
     */
    private $config;

    /**
     * cURL interface (getData / setData)
     */
    private $curl;

    /**
     * The Database
     */
    private $db;

    /**
     * The logger, outputs to logs/app.log
     */
    private $log;

    /**
     * StatsD for tracking stats
     */
    private $statsd;

    /**
     * @var array
     */
    private $pointsArray = array(
        324 => array("Assault Ship", 100),
        397 => array("Assembly Array", 10),
        1201 => array("Attack Battlecruiser", 300),
        419 => array("Battlecruiser", 250),
        27 => array("Battleship", 750),
        898 => array("Black Ops", 1800),
        1202 => array("Blockade Runner", 125),
        883 => array("Capital Industrial Ship", 1000),
        29 => array("Capsule", 5),
        547 => array("Carrier", 3000),
        906 => array("Combat Recon Ship", 350),
        540 => array("Command Ship", 450),
        365 => array("Control Tower", 250),
        471 => array("Corporate Hangar Array", 50),
        830 => array("Covert Ops", 80),
        26 => array("Cruiser", 100),
        838 => array("Cynosural Generator Array", 10),
        839 => array("Cynosural System Jammer", 50),
        420 => array("Destroyer", 60),
        485 => array("Dreadnought", 4000),
        893 => array("Electronic Attack Ship", 200),
        439 => array("Electronic Warfare Battery", 50),
        837 => array("Energy Neutralizing Battery", 50),
        543 => array("Exhumer", 20),
        833 => array("Force Recon Ship", 350),
        513 => array("Freighter", 300),
        25 => array("Frigate", 50),
        358 => array("Heavy Assault Ship", 400),
        894 => array("Heavy Interdictor", 600),
        28 => array("Industrial", 20),
        941 => array("Industrial Command Ship", 800),
        1012 => array("Infrastructure Hubs", 500),
        831 => array("Interceptor", 60),
        541 => array("Interdictor", 60),
        902 => array("Jump Freighter", 500),
        707 => array("Jump Portal Array", 10),
        832 => array("Logistics", 175),
        900 => array("Marauder", 1000),
        463 => array("Mining Barge", 20),
        449 => array("Mobile Hybrid Sentry", 10),
        413 => array("Mobile Laboratory", 10),
        430 => array("Mobile Laser Sentry", 10),
        417 => array("Mobile Missile Sentry", 10),
        426 => array("Mobile Projectile Sentry", 10),
        438 => array("Mobile Reactor", 10),
        416 => array("Moon Mining", 10),
        1106 => array("Orbital Construction Platform", 5),
        1025 => array("Orbital Infrastructure", 500),
        1022 => array("Prototype Exploration Ship", 5),
        311 => array("Refining Array", 10),
        237 => array("Rookie ship", 5),
        709 => array("Scanner Array", 10),
        440 => array("Sensor Dampening Battery", 10),
        444 => array("Shield Hardening Array", 10),
        363 => array("Ship Maintenance Array", 10),
        31 => array("Shuttle", 5),
        404 => array("Silo", 10),
        1005 => array("Sovereignty Blockade Units", 250),
        441 => array("Stasis Webification Battery", 10),
        834 => array("Stealth Bomber", 80),
        963 => array("Strategic Cruiser", 750),
        659 => array("Supercarrier", 6000),
        1305 => array("Tactical Destroyer", 450),
        1003 => array("Territorial Claim Units", 500),
        30 => array("Titan", 20000),
        473 => array("Tracking Array", 10),
        380 => array("Transport Ship", 30),
        443 => array("Warp Scrambling Battery", 10),
    );

    /**
     * @param RenaApp $app
     */
    public function __construct(RenaApp $app)
    {
        $this->app = $app;
        $this->db = $app->Db;
        $this->config = $app->baseConfig;
        $this->cache = $app->Cache;
        $this->curl = $app->cURL;
        $this->statsd = $app->StatsD;
        $this->log = $app->Logging;
    }

    /**
     * @return array
     */
    public function getPointValues()
    {
        return $this->pointsArray;
    }

    /**
     * @param $killID
     *
     * @return int|mixed
     */
    public function updatePoints($killID)
    {
        $points = $this->calculatePoints($killID);
        $this->db->execute("UPDATE participants SET points = :points WHERE killID = :killID", array(":killID" => $killID, ":points" => $points));

        return $points;
    }

    /**
     * @param $killData
     *
     * @return int|mixed
     * @throws \Exception
     */
    public function calculatePoints($killData)
    {
        $victimPoints = $this->getPoints($this->app->invTypes->getAllByID($killData["victim"]["shipTypeID"])["groupID"]);
        $victimPoints += $this->app->Prices->calculateKillValue($killData)["totalValue"] / 10000000;

        $maxPoints = round($victimPoints * 1.2);

        $involvedPoints = 0;

        foreach ($killData["attackers"] as $attacker)
            $involvedPoints += $this->getPoints($this->app->invTypes->getAllByID($attacker["shipTypeID"])["groupID"]);

        if (($victimPoints + $involvedPoints) == 0)
            return 0;

        $gankFactor = $victimPoints / ($victimPoints + $involvedPoints);
        $points = ceil($victimPoints * ($gankFactor / 0.75));

        if ($points > $maxPoints)
            $points = $maxPoints;

        $points = round($points, 0);

        // A kill is always worth at least one point
        return max(1, $points);
    }

    /**
     * @param $groupID
     *
     * @return int
     */
    public function getPoints($groupID)
    {
        if (!isset($this->pointsArray[$groupID]))
            return 0;

        $data = $this->pointsArray[$groupID];
        if (!isset($data[1]))
            return 0;

        return $data[1];
    }

    /**
     * @param $killID
     *
     * @return int|mixed
     * @throws \Exception
     */
    public function calculatePointsForKillID($killID)
    {
        $victim = $this->db->queryRow("SELECT * FROM participants WHERE killID = :killID AND isVictim = 1", array(":killID" => $killID));
        $involved = $this->db->query("SELECT * FROM partisipants WHERE killID = :killID AND isVictim = 0", array(":killID" => $killID));

        $victimPoints = $this->getPoints($victim["groupID"]);
        $victimPoints += $victim["total_price"] / 10000000;

        $maxPoints = round($victimPoints * 1.2);

        $involvedPoints = 0;

        foreach ($involved as $inv)
            $involvedPoints += $this->getPoints($inv["groupID"]);

        if (($victimPoints + $involvedPoints) == 0)
            return 0;

        $gankFactor = $victimPoints / ($victimPoints + $involvedPoints);
        $points = ceil($victimPoints * ($gankFactor / 0.75));

        if ($points > $maxPoints)
            $points = $maxPoints;

        $points = round($points, 0);

        // A kill is always worth at least one point
        return max(1, $points);
    }
}
