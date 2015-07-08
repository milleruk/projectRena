<?php
namespace ProjectRena\Task;

use ProjectRena\RenaApp;
use Cilex\Command\Command;
use ProjectRena\Lib;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZMQ;
use ZMQContext;

/**
 * Receives data from Squizz stupid queue implementation from hell
 */
class zkillboardReceiveTask extends Command
{

    /**
     */
    protected function configure()
    {
        $this->setName('zkb:run')->setDescription('Receives data from Squizz stupid queue implementation from hell');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Init rena
        $app = RenaApp::getInstance();
        $run = true;
        $oldKillID = 0;
        do
        {
            $p = \RedisQ\Action::listen("redisq.zkillboard.com");
            if($p["killID"] > $oldKillID)
            {
                $k = array();
                $k["killID"] = (int) $p["killID"];
                $k["solarSystemID"] = (int) $p["killmail"]["solarSystem"]["id"];
                $k["killTime"] = (string) $p["killmail"]["killTime"];
                $k["moonID"] = (int) @$p["killmail"]["moonID"] ? $p["killmail"]["moonID"] : 0;

                $k["victim"] = self::getVictim($p["killmail"]["victim"]);
                $k["attackers"] = self::getAttackers($p["killmail"]["attackers"]);
                $k["items"] = self::getItems($p["killmail"]["victim"]["items"]);

                $app->StatsD->increment("zKillboardReceived");

                $json = json_encode($k);
                $hash = hash("sha256", ":" . $k["killTime"] . ":" . $k["solarSystemID"] . ":" . $k["moonID"] . "::" . $k["victim"]["characterID"] . ":" . $k["victim"]["shipTypeID"] . ":" . $k["victim"]["damageTaken"] . ":");

                // Push it over zmq to the websocket
                $context = new ZMQContext();
                $socket = $context->getSocket(ZMQ::SOCKET_PUSH, "rena");
                $socket->connect("tcp://localhost:5555");
                $socket->send($json);

                $app->Db->execute("INSERT IGNORE INTO killmails (killID, hash, source, kill_json) VALUES (:killID, :hash, :source, :kill_json)", array(":killID" => $p["killID"], ":hash" => $hash, ":source" => "zkillboardRedisQ", ":kill_json" => $json));
                echo "Inserted: " . $p["killID"] . "\n";
            }
            $oldKillID = $p["killID"];
        }
        while($run == true);
    }

    private function getVictim($victim)
    {
        $victimData = array();
        $victimData["shipTypeID"] = (int) $victim["shipType"]["id"];
        $victimData["characterID"] = (int) @$victim["character"]["id"];
        $victimData["characterName"] = (string) @$victim["character"]["name"];
        $victimData["corporationID"] = (int) $victim["corporation"]["id"];
        $victimData["corporationName"] = (string) @$victim["corporation"]["name"];
        $victimData["allianceID"] = (int) @$victim["alliance"]["id"];
        $victimData["allianceName"] = (string) @$victim["alliance"]["name"];
        $victimData["factionID"] = (int) @$victim["faction"]["id"];
        $victimData["factionName"] = (string) @$victim["faction"]["name"];
        $victimData["damageTaken"] = (int) @$victim["damageTaken"];

        return $victimData;
    }

    private function getAttackers($attackers)
    {
        $aggressors = array();

        foreach($attackers as $attacker)
        {
            $aggressor = array();
            $aggressor["characterID"] = (int) @$attacker["character"]["id"];
            $aggressor["characterName"] = (string) @$attacker["character"]["name"];
            $aggressor["corporationID"] = (int) @$attacker["corporation"]["id"];
            $aggressor["corporationName"] = (string) @$attacker["corporation"]["name"];
            $aggressor["allianceID"] = (int) @$attacker["alliance"]["id"];
            $aggressor["allianceName"] = (string) @$attacker["alliance"]["name"];
            $aggressor["factionID"] = (int) @$attacker["faction"]["id"];
            $aggressor["factionName"] = (string) @$attacker["faction"]["name"];
            $aggressor["securityStatus"] = (float) @$attacker["securityStatus"];
            $aggressor["damageDone"] = (int) @$attacker["damageDone"];
            $aggressor["finalBlow"] = (int) @$attacker["finalBlow"];
            $aggressor["weaponTypeID"] = (int) @$attacker["weaponType"]["id"];
            $aggressor["shipTypeID"] = (int) @$attacker["shipType"]["id"];
            $aggressors[] = $aggressor;
        }

        return $aggressors;
    }

    private function getItems($items)
    {
        $itemsArray = array();
        foreach($items as $item)
        {
            $i = array();
            $i["typeID"] = (int) @$item["itemType"]["id"];
            $i["flag"] = (int) @$item["flag"];
            $i["qtyDropped"] = (int) @$item["quantityDropped"];
            $i["qtyDestroyed"] = (int) @$item["quantityDestroyed"];
            $i["singleton"] = (int) @$item["singleton"];
            if(isset($i["items"]))
                $i["items"] = self::getItems($i["items"]);

            $itemsArray[] = $i;
        }

        return $itemsArray;
    }
}
