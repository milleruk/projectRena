<?php

class SessionHandler implements SessionHandlerInterface
{

	/**
	 * @var int stores the time the cache should live
	 */
	private $ttl = 7200; // 2hrs of cache

	/**
	 * Opens the session
	 *
	 *
	 * @return boolean
	 */
	public function open($savePath, $sessionName)
	{
		return true;
	}

	/**
	 * Closes the session
	 *
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
	 *
	 * @return string
	 */
	public function read($id)
	{
		$data = Cache::get($id);
		if(is_array($data)) // Just to make sure that we're returning a string and not an array, eventho that shouldn't technically be possible..
			return "";
		return Cache::get($id);
	}

	/**
	 * Writes data into the session
	 *
	 *
	 * @return boolean
	 */
	public function write($id, $data)
	{
		Cache::set($id, $data, $this->ttl);
		return true;
	}

	/**
	 * Destroys the session
	 *
	 *
	 * @return boolean
	 */
	public function destroy($id)
	{
		Cache::delete($id);
		return true;
	}

	/**
	 * Garbage collects the sessions (The cache does that automatically tho)
	 *
	 *
	 * @return boolean
	 */
	public function gc($maxlifetime)
	{
		return true;
	}
}