<?php

namespace ProjectRena\Model;

use ProjectRena\Lib\Database;

/**
 * Class Config.
 */
class Config
{
    private $app;
    private $db;

    function __construct($app)
    {
        $this->app = $app;
        $this->db = $app->db;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        $dbResult = $this->db->queryField('SELECT value FROM configuration WHERE `key` = :key', 'value', array(':key' => $key));

        return $dbResult;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        global $config;
        $dbConfig = $this->db->query('SELECT * FROM configuration');
        $cfg = array_merge($config, $dbConfig);

        // Return the entire config, both from the config file and from the db
        return $cfg;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function set($key, $value)
    {
        return $this->db->execute('INSERT INTO configuration (`key`, value) VALUES (:key, :value)', array(':key' => $key, ':value' => $value));
    }
}
