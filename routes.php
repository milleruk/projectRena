<?php

// Define routes
$app->get("/", function () use ($app)
{
	// Get the flash data for this endpoint, if there is any..
	$errorMessage = $app->flashData();

	// Sample log message
	Logging::log("INFO", "Slim-Skeleton '/' route");

	// Render index view
	$app->render('index.html');
});