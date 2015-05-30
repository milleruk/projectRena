<?php
// Shit here is whining about stuff not being loaded, but it is under app.php.. ignore it..

include '../app.php';

// Session
$session = new SessionHandler();
session_set_save_handler($session, true);
session_cache_limiter(false);
session_start();

// Launch Whoops
/** @noinspection PhpParamsInspection */
/** @noinspection PhpUndefinedClassInspection */
$app->add(new WhoopsMiddleware());

// Prepare view
/** @noinspection PhpUndefinedClassInspection */
$app->view(new Twig());
$app->view->parserOptions = $config['twig'];

// Run app
$app->run();