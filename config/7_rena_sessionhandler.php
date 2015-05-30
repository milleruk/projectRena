<?php
$app->container->singleton('sessionHandler', function ($container) use($app) {
    return new ProjectRena\Lib\SessionHandler($app);
});
