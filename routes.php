<?php

// Main route
$app->get(
    "/",
    function () use ($app) {
        // Get the flash data for this endpoint, if there is any..
        $errorMessage = $app->flashData();

        Database::query("SELECT 1");
        // Sample log message
        Logging::log("INFO", "Slim-Skeleton '/' route");

        // Render index view
        $app->render('index.html');
    }
);

// API Route (Get gets the data, options gets the help information)
$app->group(
    "/api",
    function () use ($app) {
        // Combined kills
        $app->get(
            "/combined/:parameters+/",
            function ($paramters = array()) use ($app) {
                Combined::test();
            }
        );
        $app->options(
            "/combined/",
            function () use ($app) {

            }
        );

        // Kills
        $app->get(
            "/kills/:parameters+/",
            function ($paramters = array()) use ($app) {

            }
        );
        $app->options(
            "/kills/",
            function () use ($app) {

            }
        );

        // Losses
        $app->get(
            "/losses/:parameters+/",
            function ($paramters = array()) use ($app) {

            }
        );
        $app->options(
            "/losses/",
            function () use ($app) {

            }
        );

        // Market data
        $app->get(
            "/market/:parameters+/",
            function ($paramters = array()) use ($app) {

            }
        );
        $app->options(
            "/market/",
            function () use ($app) {

            }
        );

        // Info endpoint (char, corp, alli, faction, ship, group, system, region)
        $app->get(
            "/info/:callType/:parameters+/",
            function ($callType, $paramters = array()) use ($app) {

            }
        );
        $app->options(
            "/info/",
            function () use ($app) {

            }
        );

        // DNA
        $app->get(
            "/dna/:parameters+/",
            function ($paramters = array()) use ($app) {

            }
        );
        $app->options(
            "/dna/",
            function () use ($app) {

            }
        );

        // Related kills
        $app->get(
            "/related/:parameters+/",
            function ($paramters = array()) use ($app) {

            }
        );
        $app->options(
            "/related/",
            function () use ($app) {

            }
        );

        // Fixed related battle reports
        $app->get(
            "/battles/:parameters+/",
            function ($paramters = array()) use ($app) {

            }
        );
        $app->options(
            "/battles/",
            function () use ($app) {

            }
        );

        // Stats (char, corp, alli, faction, ship, group, system, region)
        $app->get(
            "/stats/:parameters+/",
            function ($paramters = array()) use ($app) {

            }
        );
        $app->options(
            "/stats/",
            function () use ($app) {

            }
        );

    }
);
