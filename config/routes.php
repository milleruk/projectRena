<?php

// Cheatsheet: https://andreiabohner.files.wordpress.com/2014/06/slim.pdf
// Main route
$app->get('/', function() use ($app){
    (new \ProjectRena\Controller\IndexController())->index($app);
});

// Paste Page
$app->get("/paste/", function() use ($app){
    (new \ProjectRena\Controller\PasteController())->pastePage($app);
});
$app->post("/paste/", function() use ($app){
    (new \ProjectRena\Controller\PasteController())->postPaste($app);
});
$app->get("/paste/:hash/", function($hash) use ($app){
    (new \ProjectRena\Controller\PasteController())->showPaste($app, $hash);
});

// Login
$app->map('/login/eve/', function() use ($app){
    (new \ProjectRena\Controller\LoginController())->loginEVE($app);
})->via('GET', 'POST');

// Logout
$app->get('/logout/', function() use ($app){
    $sessionData = $_SESSION;
    foreach($sessionData as $key => $val)
        unset($_SESSION[$key]);

    $cookieName = \ProjectRena\Lib\Service\baseConfig::getConfig("name", "cookies");
    $cookieSSL = \ProjectRena\Lib\Service\baseConfig::getConfig("ssl", "cookies");
    $app->deleteCookie($cookieName, "/", $app->request->getHost(), $cookieSSL, true);
    $app->redirect("/");
});
