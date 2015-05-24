<?php
namespace ProjectRena\Tasks\Cronjobs;

use \ProjectRena\Lib\Logging;
use Slim\Log;

class TestTwoCronjob {

    public static function getRunTimes()
    {
        return 5; // Runs every five seconds
    }
    public static function execute()
    {
        $log = new Logging();
        $log->log("DEBUG", "wtf?!");
    }
}