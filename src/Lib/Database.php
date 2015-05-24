<?php

namespace ProjectRena\Lib;

use Exception;
use PDO;
use ProjectRena\Model\Config;

class Database
{
    /**
     * @var int Stores the number of Query executions and inserts
     */
    protected static $queryCount = 0;

    /**
     * Creates and returns a PDO object.
     *
     * @static
     * @return PDO
     * @throws Exception
     */
    private static function getPDO()
    {
        $dsn = "mysql:dbname=".Config::get("name", "database").";host=".Config::get("host", "database");
        try {
            $pdo = new PDO(
                $dsn, Config::get("username", "database"), Config::get("password", "database"), array(
                    PDO::ATTR_PERSISTENT => Config::get("persistent", "database"),
                    PDO::ATTR_EMULATE_PREPARES => Config::get("emulatePrepares", "database"),
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => Config::get("useBufferedQuery", "database"),
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_Zone = '+00:00'",
                )
            );
        } catch (Exception $e) {
            $errorMessage = "Unable to connect to the database: ".$e->getMessage();
            Logger::log("DEBUG", $errorMessage);
            throw new Exception($errorMessage);
        }

        return $pdo;
    }

    /**
     * Executes an SQL query, returns the full result
     *
     * @static
     * @param string $query The query to be executed.
     * @param array $parameters (optional) A key/value array of parameters.
     * @param int $cacheTime The time, in seconds, to cache the result of the query.    Default: 30
     * @param bool $selectCheck selectCheck If true, does a strict check that the query is using a select.  Default: true
     * @return array Returns the full resultset as an array.
     * @throws Exception
     */
    public static function query($query, $parameters = array(), $cacheTime = 30, $selectCheck = true)
    {
        // Sanity check
        if (strpos($query, ";") !== false) {
            throw new Exception("Semicolons are not allowed in queries. Use parameters instead.");
        }

        // Cache time of 0 seconds means skip all caches. and just do the query
        $key = self::getKey($query, $parameters);

        // If cache time is above 0 seconds, lets try and get it from that.
        if ($cacheTime > 0) {
            // Try the cache system
            $result = Cache::get($key);
            if ($result !== false) {
                return $result;
            }
        }

        try {
            // Start the timer
            $timer = new Timer();

            // Increment the queryCounter
            self::$queryCount++;

            // Open the databse connection
            $pdo = self::getPDO();

            // Make sure PDO is set
            if ($pdo == null) {
                return;
            }

            // Prepare the query
            $stmt = $pdo->prepare($query);

            // Execute the query, with the parameters
            $stmt->execute($parameters);

            // Check for errors
            if ($stmt->errorCode() != 0) {
                return false;
            }

            // Fetch an associative array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the cursor
            $stmt->closeCursor();

            // Stop the timer
            $duration = $timer->stop();

            // If cache time is above 0 seconds, lets store it in the cache.
            if ($cacheTime > 0) {
                Cache::set($key, $result, min(3600, $cacheTime));
            } // Store it in the cache system

            // Log the query
            self::log($query, $parameters, $duration);

            // now to return the result
            return $result;
        } catch (Exception $e) {
            // There was some sort of nasty nasty nasty error..
            throw $e;
        }
    }

    /**
     * Executes an SQL query, and returns a single row
     *
     * @static
     * @param string $query The query to be executed
     * @param array $parameters (optional) A key/value array of parameters
     * @param int $cacheTime The time, in seconds, to cache the result of the query.    Default: 30
     * @return array Returns the first row of the result set. Returns an empty array if there are no rows.
     */
    public static function queryRow($query, $parameters = array(), $cacheTime = 30, $selectCheck = true)
    {
        // Get the result
        $result = self::query($query, $parameters, $cacheTime, $selectCheck);

        // Figure out if it has more than one result and return it
        if (sizeof($result) >= 1) {
            return $result[0];
        }

        // No results at all
        return array();
    }

    /**
     * Executes an SQL query, and returns a single result
     *
     * @static
     * @param string $query The query to be executed
     * @param string $field The name of the field to return
     * @param array $parameters (optional) A key/value array of parameters
     * @param int $cacheTime The time, in seconds, to cache the result of the query.    Default: 30
     * @return mixed Returns the value of $field in the first row of the resultset. Returns null if there are no results
     */
    public static function queryField($query, $field, $parameters = array(), $cacheTime = 30, $selectCheck = true)
    {
        // Get the result
        $result = self::query($query, $parameters, $cacheTime, $selectCheck);

        // Figure out if it has no results
        if (sizeof($result) == 0) {
            return null;
        }

        // Bind the first result to $resultRow
        $resultRow = $result[0];

        // Return the result + the field requested
        return $resultRow[$field];
    }

    /**
     * Executes an SQL command and returns the number of rows affected.
     * Good for inserts, updates, deletes, etc.
     *
     * @static
     * @param string $query The query to be executed.
     * @param array $parameters (optional) A key/value array of parameters.
     * @param boolean $reportErrors Log the query and throw an exception if the query fails. Default: true
     * @return int The number of rows affected by the sql query.
     */
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

        // If an error happened, rollback and return false
        if ($stmt->errorCode() != 0) {
            $pdo->rollBack();

            return false;
        }

        // Get the inserted id
        $lastInsertID = $returnID ? $pdo->lastInsertId() : 0;

        // Commitment time
        $pdo->commit();

        // ProjectRena\Lib\Timer stop
        $duration = $timer->stop();

        // Log the query
        self::log($query, $parameters, $duration);

        // Get the amount of rows that was affected
        $rowCount = $stmt->rowCount();

        // Close the cursor
        $stmt->closeCursor();

        // If return ID is needed, return that
        if ($returnID) {
            return $returnID;
        }

        // Return the amount of rows that got altered
        return $rowCount;
    }

    /**
     * Validates a query to ensure it contains no semicolons
     *
     * @static
     * @param string $query The query to be executed.
     * @throws Exception
     */
    private static function validateQuery($query)
    {
        if (strpos($query, ";") !== false) {
            throw new Exception("Semicolons are not allowed in queryes. Use parameters instead.");
        }
    }

    /**
     * Retrieve the number of queries executed so far.
     *
     * @static
     * @return int Number of queries executed so far
     */
    public static function getQueryCount()
    {
        return self::$queryCount;
    }

    /**
     * Logs a query, its parameters, and the amount of time it took to execute.
     * The original query is modified through simple search and replace to create
     * the query as close to the execution as PDO would have the query.    This
     * logging function doesn't take any care to escape any parameters, so take
     * caution if you attempt to execute any logged queries.
     *
     * @param string $query The query.
     * @param array $parameters A key/value array of parameters
     * @param int $duration The length of time it took for the query to execute.
     * @return void
     */
    public static function log($query, $parameters = array(), $duration = 0)
    {
        Logging::std_increment("website_queryCount");

        if ($duration < 10000)  // Don't log queries taking less than 10 seconds.
        {
            return;
        }

        global $baseAddr;
        foreach ($parameters as $k => $v) {
            $query = str_replace($k, "'".$v."'", $query);
        }
        $uri = isset($_SERVER["REQUEST_URI"]) ? "Query page: https://$baseAddr".$_SERVER["REQUEST_URI"]."\n" : "";
        Log::log(($duration != 0 ? number_format($duration / 1000, 3)."s " : "")." Query: \n$query;\n$uri");
    }

    /**
     * @static
     * @param string $query The query.
     * @param array $parameters The parameters
     * @return string The query and parameters as a hashed value.
     */
    public static function getKey($query, $parameters = array())
    {
        foreach ($parameters as $key => $value) {
            $query .= "|$key|$value";
        }

        return "Db:".sha1($query);
    }
}
