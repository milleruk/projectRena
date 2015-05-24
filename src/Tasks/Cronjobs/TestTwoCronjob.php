<?php
namespace ProjectRena\Tasks\Cronjobs;

/**
 * Class TestTwoCronjob
 * @package ProjectRena\Tasks\Cronjobs
 */
class TestTwoCronjob {

    /**
     * @return int
     */
    public static function getRunTimes()
    {
        return 5; // Runs every five seconds
    }

    /**
     * @param $pid
     * @param $md5
     * @param $cache
     * @param $db
     * @param $log
     */
    public static function execute($pid, $md5, $cache, $db, $log)
    {
        sleep(10);
        $log->log("INFO", "I've just slept for ten seconds, durr");
    }
}