<?php
// Load the autoloader
use ProjectRena\Lib\SessionHandler;

if (file_exists(__DIR__."/vendor/autoload.php")) {
    require_once(__DIR__."/vendor/autoload.php");
} else {
    throw new Exception("vendor/autoload.php not found, make sure you run composer install");
}

// Require the config
if (file_exists(__DIR__."/config.php")) {
    require_once(__DIR__."/config.php");
} else {
    throw new Exception("config.php not found (you might wanna start by copying config_new.php)");
}

// Prepare app
$app = new \Slim\Slim($config["slim"]);

// Session
$session = new SessionHandler();
session_set_save_handler($session, true);
session_cache_limiter(false);
session_start();

// Launch Whoops
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = $config["twig"];

// load the additional configs
foreach (glob(__DIR__."/config/*.php") as $configFile) {
    require_once $configFile;
}

// Run app
$app->run();
