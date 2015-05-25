<?php

namespace ProjectRena\Model;

use ProjectRena\Lib\Database;

/**
 * Class Config
 * @package ProjectRena\Model
 */
class Config
{
	/**
	 * Gets a config key from the config file or the database
	 *
	 * @static
	 *
	 * @param string $key The key that needs to be fetched data for
	 *
	 * @return array
	 * @internal param string $type The type, only needed for the config.php file
	 *
	 * @internal param null $default
	 */
    public static function get($key)
    {
        $dbResult = Database::queryField("SELECT value FROM configuration WHERE `key` = :key", "value", array(":key" => $key));
        return $dbResult;
    }

    /**
     * @param $key
     * @param null $type
     * @param null $default
     * @return null
     */
    public static function getConfig($key, $type = null, $default = null)
    {
        global $config;

        $type = strtolower($type);
        if(isset($config[$type]) && isset($config[$type][$key]))
            return $config[$type][$key];
        return $default;
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
        $dbConfig = Database::query("SELECT * FROM configuration");
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
        return Database::execute("INSERT INTO configuration (`key`, value) VALUES (:key, :value)", array(":key" => $key, ":value" => $value));
    }
}
