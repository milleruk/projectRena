<?php

namespace ProjectRena\Lib;

use Pheal\Cache\RedisStorage;
use Pheal\Core\Config as PhealConfig;
use Pheal\Pheal;
use ProjectRena\Model\Config;

/**
 * Class PhealLoader.
 */
class PhealLoader
{
    /**
     * @param null $apiKey
     * @param null $vCode
     *
     * @return Pheal
     */
    public static function loadPheal($apiKey = null, $vCode = null)
    {
        // Configure pheal
        PhealConfig::getInstance()->http_method = 'curl';
        PhealConfig::getInstance()->http_user_agent = Config::getConfig(
            'userAgent',
            'site',
            'API DataGetter from projectRena (karbowiak@gmail.com)'
        );
        PhealConfig::getInstance()->http_post = false;
        PhealConfig::getInstance()->http_keepalive = 10; // 10 seconds keep alive
        PhealConfig::getInstance()->http_timeout = 30;
        PhealConfig::getInstance()->cache = new RedisStorage(
            array(
                'host' => Config::getConfig('host', 'redis', '127.0.0.1'),
                'port' => Config::getConfig('port', 'redis', 6379),
                'persistent' => true,
                'auth' => null,
                'prefix' => 'Pheal',
            )
        );
        PhealConfig::getInstance()->log = new PhealLogger(); // Use the Rena Pheal Logger
        PhealConfig::getInstance()->api_customkeys = true;
        PhealConfig::getInstance()->api_base = Config::getConfig('apiServer', 'ccp', 'https://api.eveonline.com/');

        // Init the API with apiKey and vCode
        if (!empty($apiKey) && !empty($vCode)) {
            $pheal = new Pheal($apiKey, $vCode);
        } else {
            $pheal = new Pheal();
        }

        // Increment StatsD
        Logging::std_increment('ccp_api');

        // Return the pheal object
        return $pheal;
    }
}
