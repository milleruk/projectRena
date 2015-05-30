<?php

namespace ProjectRena\Lib\Service;

use Domnikl\Statsd\Client;
use Domnikl\Statsd\Connection\UdpSocket;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use ProjectRena\Model\Config;
use ProjectRena\RenaApp;

/**
 * Class Logging
 *
 * @todo find better naming for std* methods, as std is a common abbreviation for standard
 * @package ProjectRena\Lib\Service
 */
class Logging
{
    /**
     * @var RenaApp
     */
    protected $app;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param $app
     * @param $logLevel
     */
    public function __construct(RenaApp $app, $logLevel)
    {
        $this->app = $app;

        $this->logger = new Logger('projectRena');
        $this->logger->pushHandler(
            new StreamHandler(
                $app->renaConfig->getConfig('logFile', 'Logging', __DIR__.'/../../logs/app.log'),
                $logLevel
            )
        );

    }

    /**
     * Logs data into the logfile.
     *
     * @static
     *
     * @param string $logType the type of logging, debug, info, warning, error
     * @param string $logMessage the message for the log
     */
    public function log($logType, $logMessage)
    {
        $this->logger->log($logType, $logMessage);
    }

    /**
     * Inserts data into the slim flasher.
     *
     * @static
     *
     * @param string $logType the type of logging, debug, info, warning, error
     * @param string $logMessage the message for the log
     */
    public function flasher($logType, $logMessage)
    {
        $this->app->flash($logType, $logMessage);
    }

    /**
     * Initialises statsd.
     *
     * @todo ensure its only run once
     *
     * @static
     */
    private function stdInit()
    {
        $connection = new UdpSocket(
            Config::getConfig('server', 'statsd', '127.0.0.1'),
            Config::getConfig('port', 'statsd', 8125)
        );
        $statsd = new Client($connection, Config::getConfig('namespace', 'statsd', 'rena.namespace'));

        // Global name space
        $statsd->setNamespace(Config::getConfig('globalNamespace', 'statsd', 'rena'));

        return $statsd;
    }

    /**
     * Increments a value in statsd.
     *
     * @static
     *
     * @param string $name the name of the key
     * @param int $amount the amount it's incremented
     */
    public function stdIncrement($name, $amount = 1)
    {
        $this->stdInit()->increment($name, $amount = 1);
    }

    /**
     * Creates a timing list in statsd.
     *
     * @static
     *
     * @param string $name the name of the key
     * @param int $time the time it took for the request/execution to finish
     */
    public function stdTiming($name, $time)
    {
        $this->stdInit()->timing($name, $time);
    }

    /**
     * Creates a gauge in statsd.
     *
     * @static
     *
     * @param string $name the name of the key
     * @param string|int $amount the amount the gauge is increased
     */
    public function stdGauge($name, $amount)
    {
        $this->stdInit()->gauge($name, $amount);
    }
}
