<?php
// we return a singleton instance of renas config here, this allows us to
// access this abomination from within everywhere where we have access to the container

$app->container->singleton(
    'renaConfig',
    function ($container) {
        return new \ProjectRena\Model\Config();
    }
);
