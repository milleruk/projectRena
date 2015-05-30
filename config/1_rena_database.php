<?php
$app->container->singleton('db', function($container) use ($app){
    return new \ProjectRena\Lib\Service\Database($app);
});
