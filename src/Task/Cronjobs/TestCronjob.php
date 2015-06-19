<?php

namespace ProjectRena\Task\Cronjobs;

use ProjectRena\RenaApp;

/**
 * Class TestCronjob.
 */
class TestCronjob
{
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
     * @param RenaApp $app
     *
     * @throws \Exception
     */
    public static function execute($pid, $md5, $db, RenaApp $app)
    {
        $app->Logging->log('INFO', 'Hayoooo');
    }
}
