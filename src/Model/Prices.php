<?php
namespace ProjectRena\Model;

use ProjectRena\RenaApp;

/**
 * Calculates prices, and also fetches prices from the database
 */
class Prices
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

    public function getPricesForTypeID($typeID, $date = null)
    {
        if($date == null)
            $date = date("Y-m-d");

        $data = $this->db->queryRow("SELECT * FROM invPrices WHERE typeID = :typeID AND created >= :date ORDER BY created DESC LIMIT 1", array(":typeID" => $typeID, ":date" => $date));
        if(!$data)
            return $this->db->queryRow("SELECT * FROM invPrices WHERE typeID = :typeID ORDER BY created DESC LIMIT 1", array(":typeID" => $typeID));
        return $data;
    }

    public function getPriceForTypeID($typeID, $type = "avgSell", $date = null)
    {
        $validTypes = array("avgSell", "avgBuy", "lowSell", "lowBuy", "highSell", "highBuy");
        if(!in_array($type, $validTypes))
            throw new \Exception("Type not valid, please select a valid type: " . implode(", ", $validTypes));

        return $this->db->queryField("SELECT {$type} FROM invPrices WHERE typeID = :typeID ORDER BY created DESC LIMIT 1", $type, array(":typeID" => $typeID));
    }

    public function calculateKillValue($killData)
    {
        $items = $killData["items"];
        $victimShipValue = $this->getPriceForTypeID($killData["victim"]["shipTypeID"], "avgSell", $killData["killTime"]);
        $killValue = 0;

        foreach($items as $item)
        {
            $isCargo = isset($item["items"]) ? is_array($item["items"]) ? true : false : false;
            if($isCargo)
                foreach($item["items"] as $innerItem)
                    $killValue += $this->processItem($innerItem, $killData["killTime"], $isCargo);

            $killValue += $this->processItem($item, $killData["killTime"], $isCargo);

        }

        return array("itemValue" => $killValue, "shipValue" => $victimShipValue, "totalValue" => $killValue + $victimShipValue);
    }

    private function processItem($itemData, $killTime, $isCargo = false)
    {
        $typeID = $itemData["typeID"];
        $flag = $itemData["flag"];
        $itemName = $this->app->invTypes->getNameByID($typeID);
        if(!$itemName)
            $itemName = "TypeID {$typeID}";

        if($typeID == 33329 && $flag == 89)
            $price = 0.01; // Golden pod
        else
            $price = $this->getPriceForTypeID($typeID, "avgSell", $killTime);

        if($isCargo && strpos($itemName, "Blueprint") !== false)
            $itemData["singleton"] = 2;

        if($itemData["singleton"] == 2)
            $price = $price / 100;

        return ($price * ($itemData["qtyDropped"] + $itemData["qtyDestroyed"]));
    }
}
