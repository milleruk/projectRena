<?php
namespace ProjectRena\Tasks\Cronjobs;

use \ProjectRena\Lib\Logging;

class TestCronjob {

    public static function getRunTimes()
    {
        return 1; // Runs every five seconds
    }
    public static function execute()
    {
        $log = new Logging();
        $log->log("INFO", "Hayoooo");
    }
}