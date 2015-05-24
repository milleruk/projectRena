<?php

namespace ProjectRena\Lib\Cache;


/**
 * Class ApcCache
 * @package ProjectRena\Lib\Cache
 */
class ApcCache extends AbstractCache
{
    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return unserialize(apc_fetch($key));
    }

    /**
     * @param string $timeout
     */
    public function set($key, $value, $timeout)
    {
        return apc_store($key, serialize($value), $timeout);
    }

    /**
     * @param string $timeout
     */
    public function replace($key, $value, $timeout)
    {
        if (!apc_exists($key))
            return false;
        apc_store($key, serialize($value), $timeout);
    }

    /**
     * @param string $key
     */
    public function delete($key)
    {
        return apc_delete($key);
    }

    /**
     * @param $key
     * @param int $step
     * @param int $timeout
     * @return bool|int
     */
    public function increment($key, $step = 1, $timeout = 0)
    {
        apc_add($key, 0, $timeout);
        return apc_inc($key, $step);
    }

    /**
     * @param $key
     * @param int $step
     * @param int $timeout
     * @return bool|int
     */
    public function decrement($key, $step = 1, $timeout = 0)
    {
        apc_add($key, 0, $timeout);
        return apc_dec($key, $step);
    }

    /**
     * @return bool
     */
    public function flush()
    {
        return apc_clear_cache();
    }
}