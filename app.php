<?php
// Load the autoloader
require_once(__DIR__ . "/vendor/autoload.php");

// Require the config
require_once("config.php");

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

// Include Twig settings
include("twig.php");

// Include the routes
include("routes.php");

// Run app
$app->run();