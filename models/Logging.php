<?php

class Logging
{

	/**
	 * Logs data into the logfile
	 *
	 * @static
	 * @param $logType the type of logging, debug, info, warning, error
	 * @param $logMessage the message for the log
	 */
	public static function log($logType, $logMessage)
	{
		$logTypeArray = array(
			"DEBUG" => \Monolog\Logger::DEBUG,
			"INFO" => \Monolog\Logger::INFO,
			"WARNING" => \Monolog\Logger::WARNING,
			"ERROR" => \Monolog\Logger::ERROR,
		);

		$log = new \Monolog\Logger("projectRena");
		$log->pushHandler(new \Monolog\Handler\StreamHandler(Config::get("logFile", "Logging"), $logTypeArray[$logType]));
		switch($logType)
		{
			case "DEBUG":
				$log->debug($logMessage);
			break;

			case "INFO":
				$log->info($logMessage);
			break;

			case "WARNING":
				$log->warning($logMessage);
			break;

			case "ERROR":
				$log->error($logMessage);
			break;

		}
	}

	/**
	 * Inserts data into the slim flasher
	 *
	 * @static
	 * @param $logType the type of logging, debug, info, warning, error
	 * @param $logMessage the message for the log
	 */
	public static function flasher($logType, $logMessage)
	{
		global $app;
		$app->flash($logType, $logMessage);
	}

	/**
	 * Initialises statsd
	 *
	 * @static
	 */
	private static function std_init()
	{
		$connection = new \Domnikl\Statsd\Connection\UdpSocket(Config::get("server", "statsd"), Config::get("port", "statsd"));
		$statsd = new \Domnikl\Statsd\Client($connection, Config::get("namespace", "statsd"));

		// Global name space
		$statsd->setNamespace(Config::get("globalNamespace", "statsd"));

		return $statsd;
	}

	/**
	 * Increments a value in statsd
	 *
	 * @static
	 * @param $name the name of the key
	 * @param $amount the amount it's incremented
	 */
	public static function std_increment($name, $amount = 1)
	{
		$statsd = self::std_init();
		$statsd->increment($name, $amount);
	}

	/**
	 * Creates a timing list in statsd
	 *
	 * @static
	 * @param $name the name of the key
	 * @param $time the time it took for the request/execution to finish
	 */
	public static function std_timing($name, $time)
	{
		$statsd = self::std_init();
		$statsd->timing($name, $time);
	}

	/**
	 * Creates a gauge in statsd
	 *
	 * @static
	 * @param $name the name of the key
	 * @param $amount the amount the gauge is increased
	 */
	public static function std_gauge($name, $amount)
	{
		$statsd = self::std_init();
		$statsd->gauge($name, $amount);
	}
}