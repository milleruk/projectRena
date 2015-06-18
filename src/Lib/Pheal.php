<?php
namespace ProjectRena\Lib;


use Pheal\Core\Config;
use ProjectRena\RenaApp;

/**
 * Class Pheal
 *
 * @package ProjectRena\Lib
 */
class Pheal
{
<<<<<<< HEAD
	/**
	 * @var
	 */
	protected $app;

	/**
	 * @param RenaApp $app
	 * @return Pheal
	 */
	function __construct(RenaApp $app)
	{
		Config::getInstance()->http_method = 'curl';
		// we get the config instance from the container
		Config::getInstance()->http_user_agent = $app->baseConfig->getConfig(
			'userAgent',
			'site',
			'API DataGetter from projectRena (karbowiak@gmail.com)'
		);
		Config::getInstance()->http_post = false;
		Config::getInstance()->http_keepalive = 10; // 10 seconds keep alive
		Config::getInstance()->http_timeout = 30;
		Config::getInstance()->cache = new \Pheal\Cache\RedisStorage(
			array(
				'host' => $app->baseConfig->getConfig('host', 'redis', '127.0.0.1'),
				'port' => $app->baseConfig->getConfig('port', 'redis', 6379),
				'persistent' => true,
				'auth' => null,
				'prefix' => 'Pheal',
			)
		);
		Config::getInstance()->log = new \ProjectRena\Lib\PhealLogger(); // Use the Rena Pheal Logger
		Config::getInstance()->api_customkeys = true;
		Config::getInstance()->api_base = $app->baseConfig->getConfig(
			'apiServer',
			'ccp',
			'https://api.eveonline.com/'
		);
	}

	/**
	 *
	 */
	function RunAsNew() {}

	public function Pheal()
	{
		return new \Pheal\Pheal();
	}
=======
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
>>>>>>> 2e63a8c743c5d9fd0c08301854240a3ecf2b0fc8
}