<?php

class Database
{
	// Amount of queries executed
	protected static $queryCount = 0;

	// Creates the PDO object
	private static function getPDO()
	{
		global $config;
		$config = $config["database"];
		$dsn = "mysql:dbname={$config['name']};host={$config['host']}";
		try
		{
			$pdo = new PDO($dsn, $config["username"], $config["password"], array(
				PDO::ATTR_PERSISTENT => $config["persistent"],
				PDO::ATTR_EMULATE_PREPARES => $config["emulatePrepares"],
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => $config["useBufferedQuery"],
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_Zone = '+00:00'",
				)
			);
		}
		catch (Exception $e)
		{
			$errorMessage = "Unable to connect to the database: " . $e->getMessage();
			Logger::log("DEBUG", $errorMessage);
			throw new Exception($errorMessage);
		}
		return $pdo;
	}

	// Queries the database and returns all rows found
	public static function query()
	{

	}

	// Queries the database and returns a single row
	public static function queryRow()
	{

	}

	// Queries the database and returns a single field
	public static function queryField()
	{

	}

	// Executes a query in the database
	public static function execute($query, $parameters = array(), $reportErrors = true, $returnID = false)
	{
		// Init the timer
		$timer = new Timer();

		// Increment the amount of queries done
		self::$queryCount++;

		// Open the database connection
		$pdo = self::getPDO();

		// Transaction start
		$pdo->beginTransaction();

		// Prepare the query
		$stmt = $pdo->prepare($query);

		// Execute the query
		$stmt->execute($parameters);

		if($stmt->errorCode() != 0)
		{

		}
	}
}