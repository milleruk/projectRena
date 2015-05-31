<?php
$app->container->singleton('paste', function($container) use ($app){
    // the log level that is set for debugging can be set here, standard PSR log levels should be used
    return new \ProjectRena\Model\Paste($app);
});
