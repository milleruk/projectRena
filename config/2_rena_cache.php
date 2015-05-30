<?php
$app->container->singleton('cache', function($container) use ($app){
    return new \ProjectRena\Lib\Service\Cache($app);
});
