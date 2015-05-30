<?php
$app->container->singleton('statsd', function($container) use ($app){
    return new ProjectRena\Lib\Service\StatsD($app);
});
