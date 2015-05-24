<?php
namespace ProjectRena\Tasks\Cronjobs;

class TestTwoCronjob {

    public static function getRunTimes()
    {
        return 5; // Runs every five seconds
    }
    public static function execute($pid, $md5, $cache, $db, $log)
    {
        sleep(10);
        $log->log("INFO", "I've just slept for ten seconds, durr");
    }
}