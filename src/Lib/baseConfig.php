<?php
namespace ProjectRena\Lib;

class baseConfig
{
    /**
     * @param string $key
     * @param string $type
     * @param null $default
     *
     * @return null
     */
    public function getConfig($key, $type = null, $default = null)
    {
        include(__DIR__."/../../config/config.php");

        $type = strtolower($type);
        if (isset($config[$type][$key])) {
            return $config[$type][$key];
        }

        return $default;
    }
}