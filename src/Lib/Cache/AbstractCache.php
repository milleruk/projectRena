<?php
namespace ProjectRena\Lib\Cache;

/**
 * Abstract Cache
 */
abstract class AbstractCache
{
	abstract public function get($key);
	abstract public function set($key, $value, $timeout);
	abstract public function replace($key, $value, $timeout);
	abstract public function delete($key);
	abstract public function increment($key, $step, $timeout);
	abstract public function decrement($key, $step, $timeout);
	abstract public function flush();
}