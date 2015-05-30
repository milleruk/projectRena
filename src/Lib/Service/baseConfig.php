<?php
namespace ProjectRena\Lib\Service;

class baseConfig
{
    /**
     * @param $key
     * @param null $type
     * @param null $default
     *
     * @return null
     */
    public function getConfig($key, $type = null, $default = null)
    {
        //todo fix this global...
        global $config;

        $type = strtolower($type);
        if (isset($config[$type][$key])) {
            return $config[$type][$key];
        }

        return $default;
    }
}