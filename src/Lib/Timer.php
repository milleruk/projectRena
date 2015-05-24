<?php

namespace ProjectRena\Lib;

/**
 * Class Timer
 * @package ProjectRena\Lib
 */
class Timer
{
    /**
     * @var int containing the time the entire thing was started.
     */
    protected $startTime;

    /**
     * Starts the timer class
     */
    public function __construct()
    {
        $this->start();
    }

    /**
     * Starts the timer
     */
    public function start()
    {
        $this->startTime = microtime(true);
    }

    /**
     * Stops the timer
     *
     * @return int
     */
    public function stop()
    {
        return 1000 * (microtime(true) - $this->startTime);
    }
}
