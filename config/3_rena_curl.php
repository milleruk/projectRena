<?php
$app->container->singleton('curl', function($container) use ($app){
    return new \ProjectRena\Lib\cURL($app);
});
