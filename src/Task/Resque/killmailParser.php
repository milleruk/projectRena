<?php
namespace ProjectRena\Task\Resque;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Parses the killmails and populates tables
 */
class killmailParser
{
    /**
     * The Slim Application
     */
    private $app;

    /**
     * Performs the task, can access all $this->crap setup in setUp)
     */
    public function perform()
    {
        $killID = $this->args["killID"];
        $killData = json_decode($this->app->Db->queryField("SELECT kill_json FROM killmails WHERE killID = :killID", "kill_json", array(":killID" => $killID)), true);

        // Error checking - make sure that the kill has a killID set
        if (!isset($killData["killID"])) {
            $this->app->Db->execute("UPDATE killmails SET processed = 2 WHERE killID = :killID", array(":killID" => $killID));
            $this->app->Logging->log("ERROR", "Error, killmail with killID {$killID} has no valid killID set.");
            throw new Exception("Error, killmail has no valid killID set");
        }

        // Error checking - make sure that the system has a region associated
        if (!$this->app->mapSolarSystems->getRegionIDByID($killData["solarSystemID"])) {
            $this->app->Db->execute("UPDATE killmails SET processed = 2 WHERE killID = :killID", array(":killID" => $killID));
            $this->app->Logging->log("ERROR", "Error, killmail with killID {$killID} is in a system that isn't in any region in the game.");
            throw new Exception("Error, killmail is in a system that isn't in any region in the game");
        }

        // Fix the json!
        $fix = false;

        // Make sure there isn't an extra victim under victim..
        if (isset($killData["victim"]["victim"])) {
            unset($killData["victim"]["victim"]);
            $fix = true;
        }

        // Remove that goddamn stringValue..
        if (isset($killData["_stringValue"])) {
            unset($killData["_stringValue"]);
            $fix = true;
        }

        // If solarSystemID is a string, then the entire array needs to have itself fixed
        if (is_string($killData["solarSystemID"]))
            $fix = true;

        // Now fix it!
        if ($fix == true) {
            $this->app->Db->execute("UPDATE killmails SET kill_json = :newJson WHERE killID = :killID", array(
                ":killID" => $killID,
                ":newJson" => json_encode($killData, JSON_NUMERIC_CHECK),
            ));

            // Lets encode/decode the json again, but with numeric checks turned on.. ints are ints..
            $killData = json_decode(json_encode($killData, JSON_NUMERIC_CHECK), true);
        }

        // Add the victim/attacker character and corporation to the database
        \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCharacter", array("characterID" => $killData["victim"]["characterID"]));
        \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCorporation", array("corporationID" => $killData["victim"]["corporationID"]));

        foreach ($killData["attackers"] as $attacker) {
            \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCharacter", array("characterID" => $attacker["characterID"]));
            \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCorporation", array("corporationID" => $attacker["corporationID"]));
        }

        // Defaults
        $finalBlowWeaponTypeID = 0;
        $dataArray = array();

        foreach ($killData["attackers"] as $attacker) {
            if ($attacker["finalBlow"] == 1) $finalBlowWeaponTypeID = $attacker["weaponTypeID"];

            $dataArray[] = array(
                ":killID" => $killData["killID"],
                ":killTime" => $killData["killTime"],
                ":solarSystemID" => $killData["solarSystemID"],
                ":regionID" => $this->app->mapSolarSystems->getRegionIDByID($killData["solarSystemID"]),
                ":characterID" => $attacker["characterID"],
                ":corporationID" => $attacker["corporationID"],
                ":allianceID" => $attacker["allianceID"],
                ":factionID" => $attacker["factionID"],
                ":shipTypeID" => $attacker["shipTypeID"],
                ":groupID" => $this->app->invTypes->getAllByID($attacker["shipTypeID"])["groupID"],
                ":vGroupID" => $this->app->invTypes->getAllByID($killData["victim"]["shipTypeID"])["groupID"],
                ":weaponTypeID" => $attacker["weaponTypeID"],
                ":shipValue" => $this->app->Prices->getPriceForTypeID($killData["victim"]["shipTypeID"], "avgSell", $killData["killTime"]),
                ":damageDone" => $attacker["damageDone"],
                ":totalValue" => $this->app->Prices->calculateKillValue($killData)["totalValue"],
                ":pointValue" => $this->app->Points->calculatePoints($killData),
                ":numberInvolved" => count($killData["attackers"]),
                ":isVictim" => 0,
                ":finalBlow" => $attacker["finalBlow"],
                ":isNPC" => $this->isNPC($killData),
            );
        }

        $dataArray[] = array(
            ":killID" => $killData["killID"],
            ":killTime" => $killData["killTime"],
            ":solarSystemID" => $killData["solarSystemID"],
            ":regionID" => $this->app->mapSolarSystems->getRegionIDByID($killData["solarSystemID"]),
            ":characterID" => $killData["victim"]["characterID"],
            ":corporationID" => $killData["victim"]["corporationID"],
            ":allianceID" => $killData["victim"]["allianceID"],
            ":factionID" => $killData["victim"]["factionID"],
            ":shipTypeID" => $killData["victim"]["shipTypeID"],
            ":groupID" => $this->app->invTypes->getAllByID($killData["victim"]["shipTypeID"])["groupID"],
            ":vGroupID" => $this->app->invTypes->getAllByID($killData["victim"]["shipTypeID"])["groupID"],
            ":weaponTypeID" => $finalBlowWeaponTypeID,
            ":shipValue" => $this->app->Prices->getPriceForTypeID($killData["victim"]["shipTypeID"], "avgSell", $killData["killTime"]),
            ":damageDone" => 0,
            ":totalValue" => $this->app->Prices->calculateKillValue($killData)["totalValue"],
            ":pointValue" => $this->app->Points->calculatePoints($killData),
            ":numberInvolved" => count($killData["attackers"]),
            ":isVictim" => 1,
            ":finalBlow" => 0,
            ":isNPC" => $this->isNPC($killData),
        );

        // Make sure it isn't already inserted
        $count = $this->app->Db->queryField("SELECT COUNT(killID) AS cnt FROM participants WHERE killID = :killID", "cnt", array(":killID" => $killID), 0);
        if ($count >= count($dataArray))
            throw new \Exception("Kill already inserted");

        // Insert it into the database
        $this->app->Db->execute("INSERT INTO participants (killID, killTime, solarSystemID, regionID, characterID, corporationID, allianceID, factionID, shipTypeID, groupID, vGroupID, weaponTypeID, shipValue, damageDone, totalValue, pointValue, numberInvolved, isVictim, finalBlow, isNPC) VALUES (:killID, :killTime, :solarSystemID, :regionID, :characterID, :corporationID, :allianceID, :factionID, :shipTypeID, :groupID, :vGroupID, :weaponTypeID, :shipValue, :damageDone, :totalValue, :pointValue, :numberInvolved, :isVictim, :finalBlow, :isNPC)", $dataArray);

        // Update the killmails table
        $this->app->Db->execute("UPDATE killmails SET processed = 1 WHERE killID = :killID", array(":killID" => $killID));

        // Update statsd
        $this->app->StatsD->increment("killmailsProcessed");
    }

    /**
     * @param $killData
     *
     * @return bool
     */
    private function isNPC($killData)
    {
        $npc = false;
        foreach ($killData["attackers"] as $attacker)
            $npc = $attacker["characterID"] == 0 && ($attacker["corporationID"] < 1999999 && $attacker["corporationID"] != 1000125) ? true : false;

        return $npc;
    }

    /**
     * Sets up the task (Setup $this->crap and such here)
     */
    public function setUp()
    {
        $this->app = \ProjectRena\RenaApp::getInstance();
    }

    /**
     * Tears the task down, unset $this->crap and such
     */
    public function tearDown()
    {
        $this->app = null;
    }
}
