<?php
$app->container->singleton('eveapi', function($container) use ($app){
    $pheal = $app->pheal;
    return new ProjectRena\Model\EVEApi($app);
});
