<?php
namespace ProjectRena\Tasks\Cronjobs;

/**
 * Class TestCronjob
 * @package ProjectRena\Tasks\Cronjobs
 */
class TestCronjob {

    /**
     * @return int
     */
    public static function getRunTimes()
    {
        return 1; // Runs every five seconds
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
        $log->log("INFO", "Hayoooo");
    }
}