<?php

namespace ProjectRena\Lib\Service;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class Logging
 *
 * @package ProjectRena\Lib\Service
 */
class Logging
{
    private static function init()
    {
        $logger = new Logger('projectRena');
        $logger->pushHandler(
            new StreamHandler(
                baseConfig::getConfig('logFile', 'Logging', __DIR__.'/../../logs/app.log'),
                baseConfig::getConfig('logLevel', 'Logging', 200)
            )
        );

        return $logger;
    }

    /**
     * Logs data into the logfile.
     *
     * @static
     *
     * @param string $logType the type of logging, debug, info, warning, error
     * @param string $logMessage the message for the log
     */
    public static function log($logType, $logMessage)
    {
        $logger = self::init();
        $logger->log($logType, $logMessage);
    }
}
