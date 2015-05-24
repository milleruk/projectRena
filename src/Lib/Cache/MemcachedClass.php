<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 24-05-2015
 * Time: 16:00
 */

namespace ProjectRena\Lib\Cache;


use Memcached;
use ProjectRena\Model\Config;

/**
 * Class MemcachedClass
 * @package ProjectRena\Lib\Cache
 */
class MemcachedClass extends AbstractCache {
    /**
     * @var Memcached
     */
    private $mc;

    /**
     *
     */
    function __construct()
    {
        $this->mc = new Memcached("projectRena");
        $this->mc->addServer(Config::getConfig("host", "memcached", "127.0.0.1"), Config::getConfig("port", "memcached", 11211));
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->mc->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @param $timeout
     * @return bool
     */
    public function set($key, $value, $timeout)
    {
        return $this->mc->set($key, $value, $timeout);
    }

    /**
     * @param $key
     * @param $value
     * @param $timeout
     * @return bool
     */
    public function replace($key, $value, $timeout)
    {
        return $this->mc->replace($key, $value, $timeout);
    }

    /**
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        return $this->mc->delete($key);
    }

    /**
     * @param $key
     * @param int $step
     * @param int $timeout
     * @return int
     */
    public function increment($key, $step = 1, $timeout = 0)
    {
        return $this->mc->increment($key, $step);
    }

    /**
     * @param $key
     * @param int $step
     * @param int $timeout
     * @return int
     */
    public function decrement($key, $step = 1, $timeout = 0)
    {
        return $this->mc->decrement($key, -$step);
    }

    /**
     * @return bool
     */
    public function flush()
    {
        return $this->mc->flush();
    }
}