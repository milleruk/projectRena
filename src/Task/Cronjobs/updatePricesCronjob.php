<?php
namespace ProjectRena\Task\Cronjobs;

use ProjectRena\RenaApp;

/**
 * Updates prices for all market items in the invTypes table
 */
class updatePricesCronjob
{

    /**
     * Executes the cronjob task
     *
     * @param mixed $pid
     * @param mixed $md5
     */
    public static function execute($pid, $md5)
    {
        $app = RenaApp::getInstance();
        $typeIDs = $app->Db->query("SELECT typeID FROM invTypes WHERE published = 1 AND marketGroupID != 0");
        $cnt = 0;
        $fetchIDs = array();

        foreach($typeIDs as $row)
        {
            $typeID = $row["typeID"];
            $fetchIDs[] = $typeID;
            $cnt++;

            if($cnt == 20)
            {
                \Resque::enqueue("now", "\\ProjectRena\\Task\\Resque\\updatePrices", array("typeIDs" => $fetchIDs));
                $fetchIDs = array();
                $cnt = 0;
            }
        }
        exit(); // Keep this at the bottom, to make sure the fork exits
    }

    /**
     * Defines how often the cronjob runs, every 1 second, every 60 seconds, every 86400 seconds, etc.
     */
    public static function getRunTimes()
    {
        return 3600; // Never runs
    }
}
