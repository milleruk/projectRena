<?php
$app->container->singleton('timer', function($container) use ($app){
    return new \ProjectRena\Lib\Timer();
});
