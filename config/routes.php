<?php

// Main route
use ProjectRena\Lib\Database;
use ProjectRena\Lib\Logging;


$app->get("/", function () use ($app) {
        // Get the flash data for this endpoint, if there is any..
        $errorMessage = $app->flashData();

        var_dump(Database::query("SELECT 1"));

        // Sample log message
        Logging::log("INFO", "Slim-Skeleton '/' route");

        // Render index view
        $app->render('index.html');
});
