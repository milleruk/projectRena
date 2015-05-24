<?php

namespace ProjectRena\Lib;

use Domnikl\Statsd\Client;
use Domnikl\Statsd\Connection\UdpSocket;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use ProjectRena\Model\Config;

class Logging
{

    /**
     * Logs data into the logfile
     *
     * @static
     * @param string $logType the type of logging, debug, info, warning, error
     * @param string $logMessage the message for the log
     */
    public static function log($logType, $logMessage)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $logTypeArray = array(
            "DEBUG" => Logger::DEBUG,
            "INFO" => Logger::INFO,
            "WARNING" => Logger::WARNING,
            "ERROR" => Logger::ERROR,
        );

        $log = new Logger("projectRena");
        $logFile = Config::getConfig("logFile", "Logging", __DIR__ . "/../../logs/app.log");
        $log->pushHandler(new StreamHandler($logFile), $logTypeArray[$logType]);
        switch ($logType) {
            case "DEBUG":
                $log->debug($logMessage);
                break;

            case "INFO":
                $log->info($logMessage);
                break;

            case "WARNING":
                $log->warning($logMessage);
                break;

            case "ERROR":
                $log->error($logMessage);
                break;

        }
    }

    /**
     * Inserts data into the slim flasher
     *
     * @static
     * @param string $logType the type of logging, debug, info, warning, error
     * @param string $logMessage the message for the log
     */
    public static function flasher($logType, $logMessage)
    {
        global $app;
        $app->flash($logType, $logMessage);
    }

    /**
     * Initialises statsd
     *
     * @static
     */
    private static function std_init()
    {
        $connection = new UdpSocket(
            Config::getConfig("server", "statsd"),
            Config::getConfig("port", "statsd")
        );
        $statsd = new Client($connection, Config::getConfig("namespace", "statsd"));

        // Global name space
        $statsd->setNamespace(Config::getConfig("globalNamespace", "statsd"));

        return $statsd;
    }

    /**
     * Increments a value in statsd
     *
     * @static
     * @param string $name the name of the key
     * @param int $amount the amount it's incremented
     */
    public static function std_increment($name, $amount = 1)
    {
        $statsd = self::std_init();
        $statsd->increment($name, $amount);
    }

    /**
     * Creates a timing list in statsd
     *
     * @static
     * @param string $name the name of the key
     * @param int $time the time it took for the request/execution to finish
     */
    public static function std_timing($name, $time)
    {
        $statsd = self::std_init();
        $statsd->timing($name, $time);
    }

    /**
     * Creates a gauge in statsd
     *
     * @static
     * @param string $name the name of the key
     * @param string|int $amount the amount the gauge is increased
     */
    public static function std_gauge($name, $amount)
    {
        $statsd = self::std_init();
        $statsd->gauge($name, $amount);
    }
}
