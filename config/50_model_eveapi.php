<?php
$app->container->singleton('eveapi', function($container) use ($app){
    return new ProjectRena\Model\EVEApi($app);
});
