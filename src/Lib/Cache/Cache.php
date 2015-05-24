<?php

namespace ProjectRena\Lib\Cache;

use ProjectRena\Model\Config;

class Cache
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		trigger_error("The class 'cache' may only be invoked statically." . E_USER_ERROR);
	}

	/**
	 * Initiate the cache
	 *
	 * @static
	 * @return Cache
	 */
	protected static function init()
	{
        if(extension_loaded("redis") && (!empty(Config::getConfig("host", "redis"))))
            $cache = new RedisCache();
        elseif(extension_loaded("Memcached") && (!empty(Config::getConfig("host", "memcached"))))
            $cache = new MemcachedClass();
        elseif(extension_loaded("apcu") || extension_loaded("apc"))
            $cache = new ApcCache();
        else
            $cache = new FileCache();

        return $cache;
	}

	/**
	 * Get the type of cache used
	 *
	 * @return string
	 */
	public static function getClass()
	{
		return get_class(self::init());
	}

	/**
	 * Sets data to the cache
	 *
	 * @param $key
	 * @param $value
	 * @param $timeout
	 * @return bool
	 */
	public static function set($key, $value, $timeout = '3600')
	{
		$cache = self::init();
		return $cache->set($key, $value, $timeout);
	}

	/**
	 * Gets data from the cache
	 *
	 * @param $key
	 * @return array
	 */
	public static function get($key)
	{
		$cache = self::init();
		return $cache->get($key);
	}

	/**
	 * Deletes data from the cache
	 *
	 * @param string $key
	 * @return bool
	 */
	public static function delete($key)
	{
		$cache = self::init();
		return $cache->delete($key);
	}

	/**
	 * Replace a value, if it exists
	 *
	 * @param $key
	 * @param $value
	 * @param $timeout
	 * @return bool
	 */
	public static function replace($key, $value, $timeout = '3600')
	{
		$cache = self::init();
		return $cache->replace($key, $value, $timeout);
	}

	/**
	 * Increment a value
	 *
	 * @param $key
	 * @param $timeout (This only works for Memcached, file cache flat out ignores it)
	 * @return new value on success, else false
	 */
	public static function increment($key, $timeout = 3600)
	{
		$cache = self::init();
		return $cache->increment($key, 1, $timeout);
	}

	/**
	 * Decrement a value
	 *
	 * @param $key
	 * @param $timeout (This only works for Memcached, file cache flat out ignores it)
	 * @return new value on success, else false
	 */
	public static function decrement($key, $timeout = 3600)
	{
		$cache = self::init();
		return $cache->decrement($key, 1, $timeout);
	}

	/**
	 * Flush the Cache
	 *
	 * @return bool
	 */
	public static function flush()
	{
		$cache = self::init();
		return $cache->flush();
	}
}