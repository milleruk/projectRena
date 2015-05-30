<?php
$app->container->singleton('renaConfig', function ($container) {
    return new \ProjectRena\Model\Config();
});
