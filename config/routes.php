<?php

// Main route
$app->get("/", function () use ($app) {
        // Get the flash data for this endpoint, if there is any..
        $errorMessage = $app->flashData();

        // Render index view
        $app->render('index.html');
});
