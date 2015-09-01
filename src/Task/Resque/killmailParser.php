<?php
namespace ProjectRena\Task\Resque;

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

        // Add the victim/attacker character and corporation to the database
        \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCharacter", array("characterID" => $killData["victim"]["characterID"]));
        \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCorporation", array("corporationID" => $killData["victim"]["corporationID"]));

        foreach($killData["attackers"] as $attacker)
        {
            \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCharacter", array("characterID" => $attacker["characterID"]));
            \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCorporation", array("corporationID" => $attacker["corporationID"]));
        }

        // Insert all of the data to the participants table
        // killID killTime solarSystemID regionID characterID corporationID allianceID factionID shipTypeID groupID vGroupID weaponTypeID shipValue damageDone totalValue pointValue numberInvolved isVictim finalBlow isNPC

        // Defaults
        $finalBlowWeaponTypeID = 0;
        $points = 0;

        // Find out how many points the kill is worth
        $points = $this->app->Points->calculatePoints($killData);

        // Insert attacker
        foreach($killData["attackers"] as $attacker)
        {
            if($attacker["finalBlow"] == 1)
                $finalBlowWeaponTypeID = $attacker["weaponTypeID"];

            $this->app->Db->execute("INSERT IGNORE INTO participants (killID, killTime, solarSystemID, regionID, characterID, corporationID, allianceID, factionID, shipTypeID, groupID, vGroupID, weaponTypeID, shipValue, damageDone, totalValue, pointValue, numberInvolved, isVictim, finalBlow, isNPC) VALUES (:killID, :killTime, :solarSystemID, :regionID, :characterID, :corporationID, :allianceID, :factionID, :shipTypeID, :groupID, :vGroupID, :weaponTypeID, :shipValue, :damageDone, :totalValue, :pointValue, :numberInvolved, :isVictim, :finalBlow, :isNPC)",
                array(
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
                    ":isNPC"=> $this->isNPC($killData)
                )
            );
        }
        // Insert victim
        $this->app->Db->execute("INSERT IGNORE INTO participants (killID, killTime, solarSystemID, regionID, characterID, corporationID, allianceID, factionID, shipTypeID, groupID, vGroupID, weaponTypeID, shipValue, damageDone, totalValue, pointValue, numberInvolved, isVictim, finalBlow, isNPC) VALUES (:killID, :killTime, :solarSystemID, :regionID, :characterID, :corporationID, :allianceID, :factionID, :shipTypeID, :groupID, :vGroupID, :weaponTypeID, :shipValue, :damageDone, :totalValue, :pointValue, :numberInvolved, :isVictim, :finalBlow, :isNPC)",
            array(
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
                ":isNPC"=> $this->isNPC($killData)
            )
        );
    }

    private function isNPC($killData)
    {
        $npc = false;
        foreach($killData["attackers"] as $attacker)
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
