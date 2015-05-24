<?php
namespace ProjectRena\Tasks\Cronjobs;

class TestCronjob {

    public static function getRunTimes()
    {
        return 1; // Runs every five seconds
    }
    public static function execute($pid, $md5, $cache, $db, $log)
    {
        $log->log("INFO", "Hayoooo");
    }
}