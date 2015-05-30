<?php
$app->container->singleton('userConfig', function ($container) use($app) {
    return new ProjectRena\Model\Config($app);
});
