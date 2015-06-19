<?php
namespace ProjectRena\Model;

use ProjectRena\RenaApp;

class Storage
{
    private $app;
    private $db;
    private $config;

    function __construct(RenaApp $app)
    {
        $this->app = $app;
        $this->db = $this->app->Db;
        $this->config = $this->app->baseConfig;
    }

    function get($key, $default = null)
    {
        $value = Db::queryField("SELECT value FROM storage WHERE key = :key", "value", array(":key" => $key), 0);

        if(!$value)
            return $default;
        return $value;
    }

    function set($key, $value)
    {
        return Db::execute("REPLACE INTO storage (key, value) VALUES (:key, :value)", array(":key" => $key, ":value" => $value));
    }
}