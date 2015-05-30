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
}
