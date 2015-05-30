<?php
$app->container->singleton('baseConfig', function ($container) use($app) {
    return new ProjectRena\Lib\Service\baseConfig();
});
