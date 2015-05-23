<?php

class Logging
{
	private static $logFile = __DIR__ . "/../logs/app.log";

	// Log file location generator
	private function __construct()
	{
		global $config;

		if(isset($config["logger"]["logFile"]))
			$this->logFile = $config["logger"]["logFile"];
	}

	// Monolog logger
	public static function log($logType, $logMessage)
	{
		$logTypeArray = array(
			"DEBUG" => \Monolog\Logger::DEBUG,
			"INFO" => \Monolog\Logger::INFO,
			"WARNING" => \Monolog\Logger::WARNING,
			"ERROR" => \Monolog\Logger::ERROR,
		);

		$log = new \Monolog\Logger("projectRena");
		$log->pushHandler(new \Monolog\Handler\StreamHandler(self::$logFile, $logTypeArray[$logType]));
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

	// Slim Flasher
	public static function flasher($logType, $logMessage)
	{
		global $app;
		$app->flash($logType, $logMessage);
	}

	// Statsd
	private static function std_init()
	{
		global $config;
		$config = $config["statsd"];

		$connection = new \Domnikl\Statsd\Connection\UdpSocket($config["server"], $config["port"]);
		$statsd = new \Domnikl\Statsd\Client($connection, $config["namespace"]);

		// Global name space
		$statsd->setNamespace($config["globalNamespace"]);

		return $statsd;
	}
	public static function std_increment($name, $amount = 1)
	{
		$statsd = self::std_init();
		$statsd->increment($name, $amount);
	}

	public static function std_timing($name, $time)
	{
		$statsd = self::std_init();
		$statsd->timing($name, $time);
	}

	public static function std_gauge($name, $amount)
	{
		$statsd = self::std_init();
		$statsd->gauge($name, $amount);
	}
}