<?php

// Load the init system
require_once("init.php");

// Prepare app
$app = new \Slim\Slim($config["slim"]);

// Launch Whoops
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

// Create monolog logger and store logger in container as singleton
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('projectRena');
    $log->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . "/logs/app.log", \Monolog\Logger::DEBUG));
    return $log;
});

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = $config["twig"];

// Include Twig settings
include("twig.php");

// Include the routes
include("routes.php");

// Run app
$app->run();