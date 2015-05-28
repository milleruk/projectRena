<?php
// Cheatsheet: https://andreiabohner.files.wordpress.com/2014/06/slim.pdf
// Main route
$app->get("/", function() use ($app){
	\ProjectRena\Controller\IndexController::hello($app);
});

$app->get("/:name", function($name) use ($app){
	\ProjectRena\Controller\IndexController::helloName($app, $name);
});

$app->map("/login/eve/", function() use ($app){
	\ProjectRena\Controller\LoginController::loginEVE($app);
})->via("GET", "POST");