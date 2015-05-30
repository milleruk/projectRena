<?php

// we only need to run the configuration for pheal once, as this is shared through
// all instances:

\Pheal\Core\Config::getInstance()->http_method = 'curl';

// we get the config instance from the container
\Pheal\Core\Config::getInstance()->http_user_agent = $app->renaConfig->getConfig(
    'userAgent',
    'site',
    'API DataGetter from projectRena (karbowiak@gmail.com)'
);
\Pheal\Core\Config::getInstance()->http_post = false;
\Pheal\Core\Config::getInstance()->http_keepalive = 10; // 10 seconds keep alive
\Pheal\Core\Config::getInstance()->http_timeout = 30;
\Pheal\Core\Config::getInstance()->cache = new \Pheal\Cache\RedisStorage(
    array(
        'host' => $app->renaConfig->getConfig('host', 'redis', '127.0.0.1'),
        'port' => $app->renaConfig->getConfig('port', 'redis', 6379),
        'persistent' => true,
        'auth' => null,
        'prefix' => 'Pheal',
    )
);
\Pheal\Core\Config::getInstance()->log = new ProjectRena\Lib\PhealLogger(); // Use the Rena Pheal Logger
\Pheal\Core\Config::getInstance()->api_customkeys = true;
\Pheal\Core\Config::getInstance()->api_base = $app->renaConfig->getConfig(
    'apiServer',
    'ccp',
    'https://api.eveonline.com/'
);


// now that we have setup the config, we also declare our service for the DI:
// we use set, as we might want the ability to get multiple instances of pheal
$app->container->set('pheal', function($container) use($app) {
    $app->logger->stdIncrement('ccp_api');
    return new Pheal\Pheal();
});
