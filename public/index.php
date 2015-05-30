<?php

require_once '../app.php';

// Session
$session = new SessionHandler();
session_set_save_handler($session, true);
session_cache_limiter(false);
session_start();

// Launch Whoops
$app->add(new WhoopsMiddleware());

// Prepare view
$app->view(new Twig());
$app->view->parserOptions = $config['twig'];

// Run app
$app->run();