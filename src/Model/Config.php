<?php

namespace ProjectRena\Model;

use ProjectRena\Lib\Database;

class Config
{
    /**
     * Gets a config key from the config file or the database
     *
     * @static
     * @param string $key The key that needs to be fetched data for
     * @param string $type The type, only needed for the config.php file
     *
     * @param null $default
     * @return array
     */
    public static function get($key, $type = null, $default = null)
    {
        global $config;

        // Lets just be sure that the type is set to lower.. It's only needed for the config array anyway
        $type = strtolower($type);
        if (isset($config[$type]) && isset($config[$type][$key]))
            return $config[$type][$key];

        // The config returned nothing, lets get it from the database.. if it exists there.. v0v..
        $dbResult = Database::queryField("SELECT value FROM config WHERE key = :key", "value", array(":key" => $key));

        // If the dbResult isn't set, but default is, return default otherwise fallthrough and return the dbResult, whatever it might be..
        if(!isset($dbResult) && isset($default))
            return $default;
        return $dbResult;
    }

    /**
     * Returns all config parameters available
     *
     * @static
     * @return array all the config rows
     */
    public static function getAll()
    {
        global $config;
        $dbConfig = Database::query("SELECT * FROM config");
        $cfg = array_merge($config, $dbConfig);

        // Return the entire config, both from the config file and from the db
        return $cfg;
    }

    /**
     * Sets a config key in the database (Not the config.php file, since it's supposed to be static)
     *
     * @static
     * @param string $key The key that needs to be fetched data for
     * @param string $value The value of the config parameter
     *
     * @return int rows changed
     */
    public static function set($key, $value)
    {
        return Database::execute(
            "INSERT INTO config (key, value) VALUES (:key, :value)",
            array(":key" => $key, ":value" => $value)
        );
    }
}
