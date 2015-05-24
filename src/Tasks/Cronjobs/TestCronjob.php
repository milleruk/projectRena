<?php
namespace ProjectRena\Tasks\Cronjobs;

use \ProjectRena\Lib\Logging;

class TestCronjob {

    public static function getRunTimes()
    {
        return 5; // Runs every five seconds
    }
    public static function execute()
    {
        Logging::log("INFO", "Hayoooo");
    }
}