<?php

namespace ProjectRena\Task\Cronjobs;

use ProjectRena\RenaApp;

/**
 * Class updateCharactersCronjob
 *
 * @package ProjectRena\Task\Cronjobs
 */
class updateCharactersCronjob
{
    /**
     * @return int
     */
    public static function getRunTimes()
    {
        return 60; // Runs every 60 seconds
    }

    /**
     * @param $pid
     * @param $md5
     */
    public static function execute($pid, $md5)
    {
        $app = RenaApp::getInstance();
        if ($app->Storage->get("Api904") >= date("Y-m-d H:i:s"))
            return;

        $characters = $app->Db->query("SELECT characterID FROM characters WHERE lastUpdated < date_sub(now(), INTERVAL 7 DAY) AND characterID != 0 ORDER BY lastUpdated LIMIT 500", array(), 0);
        if ($characters) {
            foreach ($characters as $character) {
                // Get the characterID to update
                $characterID = $character["characterID"];

                // Throw the ID after Resque which will update the characters information
                \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateCharacter", array("characterID" => $characterID));
            }
        }
        exit();
    }
}