<?php

namespace ProjectRena\Lib;

use Exception;
use PDO;
use ProjectRena\Model\Config;

/**
 * Class Database
 * @package ProjectRena\Lib
 */
class Database
{
    /**
     * @var int
     */
    protected static $queryCount = 0;

    /**
     * @return PDO
     * @throws Exception
     */
    protected static function getPDO()
    {
        $dsn = "mysql:dbname=".Config::getConfig("name", "database").";host=".Config::getConfig("host", "database");
        try {
            $pdo = new PDO($dsn, Config::getConfig("username", "database"), Config::getConfig("password", "database"), array(
                    PDO::ATTR_PERSISTENT => Config::getConfig("persistent", "database"),
                    PDO::ATTR_EMULATE_PREPARES => Config::getConfig("emulatePrepares", "database"),
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => Config::getConfig("useBufferedQuery", "database"),
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_Zone = '+00:00'",
                )
            );
        } catch (Exception $e) {
            $errorMessage = "Unable to connect to the database: ".$e->getMessage();
            Logging::log("DEBUG", $errorMessage);
            throw new Exception($errorMessage);
        }

        return $pdo;
    }

    /**
     * @param $query
     * @param array $parameters
     * @param int $cacheTime
     * @return array|bool
     * @throws Exception
     */
    public static function query($query, $parameters = array(), $cacheTime = 30)
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
            if (!empty($result))
                return $result;
        }

        try {
            // Start the timer
            $timer = new Timer();

            // Increment the queryCounter
            self::$queryCount++;

            // Open the database connection
            $pdo = self::getPDO();

            // Make sure PDO is set
            if ($pdo == null) {
                return null;
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
            if ($cacheTime > 0)
                Cache::set($key, $result, min(3600, $cacheTime)); // Store it in the cache system

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
     * @param $query
     * @param array $parameters
     * @param int $cacheTime
     * @return array
     * @throws Exception
     */
    public static function queryRow($query, $parameters = array(), $cacheTime = 30)
    {
        // Get the result
        $result = self::query($query, $parameters, $cacheTime);

        // Figure out if it has more than one result and return it
        if (sizeof($result) >= 1) {
            return $result[0];
        }

        // No results at all
        return array();
    }

    /**
     * @param $query
     * @param $field
     * @param array $parameters
     * @param int $cacheTime
     * @return null
     * @throws Exception
     */
    public static function queryField($query, $field, $parameters = array(), $cacheTime = 30)
    {
        // Get the result
        $result = self::query($query, $parameters, $cacheTime);

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
     * @param $query
     * @param array $parameters
     * @param bool $returnID
     * @return bool|int|string
     * @throws Exception
     */
    public static function execute($query, $parameters = array(), $returnID = false)
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
        $returnID = $returnID ? $pdo->lastInsertId() : 0;

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
     * @param $query
     * @throws Exception
     */
    private static function validateQuery($query)
    {
        if (strpos($query, ";") !== false) {
            throw new Exception("Semicolons are not allowed in queries. Use parameters instead.");
        }
    }

    /**
     * @return int
     */
    public static function getQueryCount()
    {
        return self::$queryCount;
    }

    /**
     * @param $query
     * @param array $parameters
     * @param int $duration
     */
    public static function log($query, $parameters = array(), $duration = 0)
    {
        Logging::std_increment("website_queryCount");

        if ($duration < 10000)  // Don't log queries taking less than 10 seconds.
            return;

        $baseAddr = "";
        foreach ($parameters as $k => $v) {
            $query = str_replace($k, "'".$v."'", $query);
        }
        $uri = isset($_SERVER["REQUEST_URI"]) ? "Query page: https://$baseAddr".$_SERVER["REQUEST_URI"]."\n" : "";
        Logging::log("INFO", ($duration != 0 ? number_format($duration / 1000, 3)."s " : "")." Query: \n$query;\n$uri");
    }

    /**
     * @param $query
     * @param array $parameters
     * @return string
     */
    public static function getKey($query, $parameters = array())
    {
        foreach ($parameters as $key => $value) {
            $query .= "|$key|$value";
        }

        return "Db:".sha1($query);
    }
}
