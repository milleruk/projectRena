<?php
namespace ProjectRena\Task\Cronjobs;

use ProjectRena\RenaApp;

/**
 * Takes API Keys and checks them for accessmask, and a few other things
 */
class apiKeyCheckerCronjob
{

    /**
     * Executes the cronjob task
     *
     * @param mixed $pid
     * @param mixed $md5
     * @param RenaApp $app
     */
    public static function execute($pid, $md5, RenaApp $app)
    {
        // Select 1000 characters which lastValidation was over 7 days ago, then update them
        $apiKeys = $app->Db->query("SELECT keyID, vCode FROM apiKeys WHERE lastValidation < date_sub(now(), INTERVAL 1 HOUR) ORDER BY lastValidation DESC LIMIT 1000", array(), 0);

        if($apiKeys)
        {
            foreach($apiKeys as $api)
            {
                $keyID = $api["keyID"];
                $vCode = $api["vCode"];
                \Resque::enqueue("default", "\\ProjectRena\\Task\\Resque\\updateApiKeys", array("keyID" => $keyID, "vCode" => $vCode));
            }
        }
        exit();
    }

    /**
     * Defines how often the cronjob runs, every 1 second, every 60 seconds, every 86400 seconds, etc.
     */
    public static function getRunTimes()
    {
        return 60; // Never runs
    }
}
