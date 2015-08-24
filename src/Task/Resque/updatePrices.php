<?php
namespace ProjectRena\Task\Resque;

/**
 * Fetches the data for the price table from EVE Central
 */
class updatePrices
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
        $typeIDs = $this->args["typeIDs"];

        // Get all the data from EVE Central
        $pricingData = $this->app->EveCentral->getPrices($typeIDs);

        // Loop through all the typeID
        foreach($pricingData as $typeID => $data)
        {
            $avgSell = 0;
            $lowSell = 0;
            $highSell = 0;
            $avgBuy = 0;
            $lowBuy = 0;
            $highBuy = 0;

            switch($typeID)
            {
                // Customs Office
                case 2233:
                    // Fetch the price for gantry, nodes, modules, mainframes, cores and sum it up, that's the price for a customs office
                    $gantry = $this->app->EveCentral->getPrice(3962)["sell"]["min"];
                    $nodes = $this->app->EveCentral->getPrice(2867)["sell"]["min"];
                    $modules = $this->app->EveCentral->getPrice(2871)["sell"]["min"];
                    $mainframes = $this->app->EveCentral->getPrice(2876)["sell"]["min"];
                    $cores = $this->app->EveCentral->getPrice(2872)["sell"]["min"];
                    $avgSell = $gantry + (($nodes + $modules + $mainframes + $cores) * 8);
                    break;

                // Motherships
                case 3628:
                case 22852:
                case 23913:
                case 23917:
                case 23919:
                    $avgSell = 20000000000; // 20b
                    break;

                // Revenant
                case 3514:
                    $avgSell = 100000000000; // 100b
                    break;

                // Titans
                case 671:
                case 3764:
                case 11567:
                case 23773:
                    $avgSell = 100000000000; // 100b
                    break;

                // Turney frigs
                case 2834:
                case 3516:
                case 11375:
                    $avgSell = 80000000000; // 80b
                    break;

                // Chremoas
                case 33397:
                    $avgSell = 120000000000; // 120b
                    break;
                // Cambion
                case 32788:
                    $avgSell = 100000000000; // 100b
                    break;

                // Adrestia
                case 2836:
                    $avgSell = 150000000000; // 150b
                    break;
                // Vangel
                case 3518:
                    $avgSell = 90000000000; // 90b
                    break;
                // Etana
                case 32790:
                    $avgSell = 100000000000; // 100b
                    break;
                // Moracha
                case 33395:
                    $avgSell = 125000000000; // 125b
                    break;
                // Mimir
                case 32209:
                    $avgSell = 100000000000; // 100b
                    break;

                // Chameleon
                case 33675:
                    $avgSell = 120000000000; // 120b
                    break;
                // Whiptail
                case 33673:
                    $avgSell = 100000000000; // 100b
                    break;

                // Polaris
                case 9860:
                    $avgSell = 1000000000000; // 1t
                    break;
                // Cockroach
                case 11019:
                    $avgSell = 1000000000000; // 1t
                    break;

                // Gold Magnate
                case 11940:
                    // Silver Magnate
                case 11942:
                    // Opux Luxury Yacht
                case 635:
                    // Guardian-Vexor
                case 11011:
                    // Opux Dragoon Yacht
                    $avgSell = 500000000000; // 500b
                    break;

                // Megathron Federate Issue
                case 13202:
                    // Raven State Issue
                case 26840:
                    // Apocalypse Imperial Issue
                case 11936:
                    // Armageddon Imperial Issue
                case 11938:
                    // Tempest Imperial Issue
                case 26842:
                    $avgSell = 750000000000; // 750b
                    break;

                // Fallthrough
                default:
                    $avgSell = $data["sell"]["avg"];
                    $lowSell = $data["sell"]["min"];
                    $highSell = $data["sell"]["max"];
                    $avgBuy = $data["buy"]["avg"];
                    $lowBuy = $data["buy"]["min"];
                    $highBuy = $data["buy"]["max"];

                    // If the selling price is under 0.05% different from the buying price then we swap them..
                    if($highBuy > 0 && $lowSell > 0)
                    {
                        if((($highBuy / $lowSell) * 100) < 0.05)
                        {
                            // Make sure it has no chance of being duplicated
                            $duplicationChance = $this->app->Db->queryField("SELECT chanceOfDuplicating FROM invTypes WHERE typeID = :typeID", "chanceOfDuplicating", array(":typeID" => $typeID));
                            if($duplicationChance == 0)
                            {
                                $avgSell = $data["buy"]["avg"];
                                $lowSell = $data["buy"]["min"];
                                $highSell = $data["buy"]["max"];
                                $avgBuy = $data["buy"]["avg"];
                                $lowBuy = $data["buy"]["min"];
                                $highBuy = $data["buy"]["max"];
                            }
                        }
                    }
                    break;
            }

            $date = $data["date"];

            // a fallthrough for pre-defined prices
            if($lowSell == 0) $lowSell = $avgSell;

            if($highSell == 0) $highSell = $avgSell;

            // Now we just insert it all and call it a day
            $this->app->Db->execute("INSERT INTO invPrices (typeID, avgSell, lowSell, highSell, avgBuy, lowBuy, highBuy) VALUES (:typeID, :avgSell, :lowSell, :highSell, :avgBuy, :lowBuy, :highBuy) ON DUPLICATE KEY UPDATE avgSell = :avgSell, lowSell = :lowSell, highSell = :highSell, avgBuy = :avgBuy, lowBuy = :lowBuy, highBuy = :highBuy", array(
                    ":typeID"    => $typeID,
                    ":avgSell"  => $avgSell,
                    ":lowSell"  => $lowSell,
                    ":highSell" => $highSell,
                    ":avgBuy"    => $avgBuy,
                    ":lowBuy"    => $lowBuy,
                    ":highBuy"   => $highBuy,
                ));

            $this->app->StatsD->increment("ecPriceUpdates");
        }
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
