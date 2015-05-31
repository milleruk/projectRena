<?php

// Imports
use Slim\Views\Twig;
use ProjectRena\Lib\SessionHandler;
use Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware;

// Error display
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Load the autoloader
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
} else {
    throw new Exception('vendor/autoload.php not found, make sure you run composer install');
}

// Require the config
if (file_exists(__DIR__.'/config.php')) {
    require_once __DIR__.'/config.php';
} else {
    throw new Exception('config.php not found (you might wanna start by copying config_new.php)');
}

// Prepare app
$app = new \ProjectRena\RenaApp($config['slim']);

// Launch Whoops
$app->add(new WhoopsMiddleware());

// Prepare view
$app->view(new Twig());
$app->view->parserOptions = $config['twig'];

// load the additional configs
$configFiles = glob(__DIR__.'/config/*.php');
foreach ($configFiles as $configFile) {
    require_once $configFile;
}

// Try and auto login the person
$app->users->tryAutologin();

// Run app
$app->run();
