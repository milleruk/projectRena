<?php
namespace ProjectRena\Lib;


use ProjectRena\RenaApp;

class Pheal
{
 protected $app;

 function __construct(RenaApp $app)
 {
  \Pheal\Core\Config::getInstance()->http_method = 'curl';
  // we get the config instance from the container
  \Pheal\Core\Config::getInstance()->http_user_agent = $app->baseConfig->getConfig(
   'userAgent',
   'site',
   'API DataGetter from projectRena (karbowiak@gmail.com)'
  );
  \Pheal\Core\Config::getInstance()->http_post = false;
  \Pheal\Core\Config::getInstance()->http_keepalive = 10; // 10 seconds keep alive
  \Pheal\Core\Config::getInstance()->http_timeout = 30;
  \Pheal\Core\Config::getInstance()->cache = new \Pheal\Cache\RedisStorage(
   array(
    'host' => $app->baseConfig->getConfig('host', 'redis', '127.0.0.1'),
    'port' => $app->baseConfig->getConfig('port', 'redis', 6379),
    'persistent' => true,
    'auth' => null,
    'prefix' => 'Pheal',
   )
  );
  \Pheal\Core\Config::getInstance()->log = new \ProjectRena\Lib\PhealLogger(); // Use the Rena Pheal Logger
  \Pheal\Core\Config::getInstance()->api_customkeys = true;
  \Pheal\Core\Config::getInstance()->api_base = $app->baseConfig->getConfig(
   'apiServer',
   'ccp',
   'https://api.eveonline.com/'
  );
 }
}