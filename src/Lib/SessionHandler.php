<?php

namespace ProjectRena\Lib;

use ProjectRena\Lib\Cache\Cache;
use SessionHandlerInterface;

class SessionHandler implements SessionHandlerInterface
{

    /**
     * @var int stores the time the cache should live
     */
    private $ttl = 7200; // 2hrs of cache

    /**
     * Opens the session
     *
     * @param string $savePath
     * @param string $sessionName
     * @return bool
     */
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * Closes the session
     *
     * @return boolean
     */
    public function close()
    {
        return true;
    }

    /**
     * Reads the data in the session
     *
     * @param string $id
     * @return string
     */
    public function read($id)
    {
        $data = Cache::get($id);
        if (is_array(
            $data
        )) // Just to make sure that we're returning a string and not an array, eventho that shouldn't technically be possible..
        {
            return "";
        }

        return Cache::get($id);
    }

    /**
     * Writes data into the session
     *
     * @param string $id
     * @param string $data
     * @return bool
     */
    public function write($id, $data)
    {
        Cache::set($id, $data, $this->ttl);

        return true;
    }

    /**
     * Destroys the session
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        Cache::delete($id);

        return true;
    }

    /**
     * Garbage collects the sessions (The cache does that automatically tho)
     *
     * @param int $maxlifetime
     * @return bool
     */
    public function gc($maxlifetime)
    {
        return true;
    }
}
