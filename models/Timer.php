<?php

class Timer
{
	protected $startTime;

	public function __construct()
	{
		$this->start();
	}

	public function start()
	{
		$this->startTime = microtime(true);
	}

	public function stop()
	{
		return 1000 * (microtime(true) - $this->startTime);
	}
}