<?php
namespace ProjectRena\Model;

use ProjectRena\RenaApp;

/**
 * Fetches pricing data from EVE Central
 */
class EveCentral
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
     * Fetches pricing data for one typeID
     *
     * @param $typeID
     * @param int $regionID
     *
     * @return array
     */
    public function getPrice($typeID, $regionID = 10000002)
    {
        $address = "http://api.eve-central.com/api/marketstat";
        $data = $this->app->cURL->getData($address . "?typeid={$typeID}&regionlimit={$regionID}");
        $data = json_decode(json_encode(simplexml_load_string($data)), true);

        return array("date" => date("Y-m-d"), "buy" => array("min" => $data["marketstat"]["type"]["buy"]["min"], "avg" => $data["marketstat"]["type"]["buy"]["avg"], "max" => $data["marketstat"]["type"]["buy"]["max"]), "sell" => array("min" => $data["marketstat"]["type"]["sell"]["min"], "avg" => $data["marketstat"]["type"]["sell"]["avg"], "max" => $data["marketstat"]["type"]["sell"]["max"]));
    }

    /**
     * Fetches pricing data for an array of typeIDs
     *
     * @param array $typeID
     * @param int $regionID
     *
     * @return array
     */
    public function getPrices($typeID = array(), $regionID = 10000002)
    {
        $address = "http://api.eve-central.com/api/marketstat?regionlimit={$regionID}";

        foreach ($typeID as $id)
            $address .= "&typeid={$id}";

        $data = $this->app->cURL->getData($address);
        $data = json_decode(json_encode(simplexml_load_string($data)), true);

        $items = $data["marketstat"]["type"];
        $prices = array();

        foreach ($items as $item)
            $prices[$item["@attributes"]["id"]] = array("date" => date("Y-m-d"), "buy" => array("min" => $item["buy"]["min"], "avg" => $item["buy"]["avg"], "max" => $item["buy"]["max"]), "sell" => array("min" => $item["sell"]["min"], "avg" => $item["sell"]["avg"], "max" => $item["sell"]["max"]));

        return $prices;
    }
}
