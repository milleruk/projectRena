<?php
// we need one logger instance in total, so singleton. As the constructor of
// the Logging service takes $app, we have to use it within the closure
$app->container->singleton('logger', function($container) use ($app){
    // the log level that is set for debugging can be set here, standard PSR log levels should be used
    return new \ProjectRena\Lib\Service\Logging($app, \Psr\Log\LogLevel::DEBUG);
});
