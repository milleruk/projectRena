<?php
namespace ProjectRena\Lib\Service;

use Domnikl\Statsd\Client;
use Domnikl\Statsd\Connection\UdpSocket;

/**
 * Class StatsD
 *
 * @package ProjectRena\Lib\Service
 */
class StatsD
{
    private static function init()
    {
        $connection = new UdpSocket(
            baseConfig::getConfig('server', 'statsd', '127.0.0.1'),
            baseConfig::getConfig('port', 'statsd', 8125)
        );
        $statsd = new Client($connection, baseConfig::getConfig('namespace', 'statsd', 'rena.namespace'));

        // Global name space
        $statsd->setNamespace(baseConfig::getConfig('globalNamespace', 'statsd', 'rena'));

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
    public static function increment($name, $amount = 1)
    {
        $statsd = self::init();
        $statsd->increment($name, $amount = 1);
    }

    /**
     * Creates a timing list in statsd.
     *
     * @static
     *
     * @param string $name the name of the key
     * @param int $time the time it took for the request/execution to finish
     */
    public static function timing($name, $time)
    {
        $statsd = self::init();
        $statsd->timing($name, $time);
    }

    /**
     * Creates a gauge in statsd.
     *
     * @static
     *
     * @param string $name the name of the key
     * @param string|int $amount the amount the gauge is increased
     */
    public static function gauge($name, $amount)
    {
        $statsd = self::init();
        $statsd->gauge($name, $amount);
    }
}