<?php

// Cheatsheet: https://andreiabohner.files.wordpress.com/2014/06/slim.pdf
// Main route
$app->get(
    '/',
    function () use ($app) {
        (new \ProjectRena\Controller\IndexController($app))->hello();
    }
);

$app->get(
    '/:name',
    function ($name) use ($app) {
        (new \ProjectRena\Controller\IndexController($app))->helloName($name);
    }
);

$app->map(
    '/login/eve/',
    function () use ($app) {
        (new \ProjectRena\Controller\LoginController($app))->loginEVE();
    }
)->via('GET', 'POST');
