<?php

// Cheatsheet: https://andreiabohner.files.wordpress.com/2014/06/slim.pdf
// Main route
$app->get('/', function() use ($app){
    (new \ProjectRena\Controller\IndexController($app))->hello();
});

$app->get('/:name', function($name) use ($app){
    (new \ProjectRena\Controller\IndexController($app))->helloName($name);
});

$app->map('/login/eve/', function() use ($app){
    (new \ProjectRena\Controller\LoginController($app))->loginEVE();
})->via('GET', 'POST');

$app->get('/logout/', function() use ($app){
    unset($_SESSION["loggedin"]);
    $cookieName = $app->baseConfig->getConfig("name", "cookies");
    $cookieSSL = $app->baseConfig->getConfig("ssl", "cookies");
    $app->deleteCookie($cookieName, "/", $app->request->getHost(), $cookieSSL, true);
    unset($_COOKIE[$app->baseConfig->getConfig("name", "cookies")]);
    $app->redirect("/");
});
