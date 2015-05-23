<?php

// Define routes
$app->get("/", function () use ($app)
{
	$errorMessage = $app->flashData();
	Logging::flasher("info", "asdf");
	var_dump(Database::execute("SELECT 1"));
	// Sample log message
	Logging::log("INFO", "Slim-Skeleton '/' route");

	// Render index view
	$app->render('index.html');
});