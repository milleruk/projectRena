<?php
// Cheatsheet: https://andreiabohner.files.wordpress.com/2014/06/slim.pdf
// Main route
$app->get('/', function () use ($app){
    (new \ProjectRena\Controller\IndexController($app))->index();
});

// Paste Page
$app->get("/paste/", function () use ($app){
    (new \ProjectRena\Controller\PasteController($app))->pastePage();
});
$app->post("/paste/", function () use ($app){
    (new \ProjectRena\Controller\PasteController($app))->postPaste();
});
$app->get("/paste/:hash/", function ($hash) use ($app){
    (new \ProjectRena\Controller\PasteController($app))->showPaste($hash);
});

// Login
$app->get('/login/eve/', function () use ($app){
    (new \ProjectRena\Controller\LoginController($app))->loginEVE();
});

// Logout
$app->get('/logout/', function () use ($app){
    $sessionData = $_SESSION;
    foreach($sessionData as $key => $val) unset($_SESSION[$key]);

    $cookieName = $app->baseConfig->getConfig("name", "cookies");
    $cookieSSL = $app->baseConfig->getConfig("ssl", "cookies");
    $app->deleteCookie($cookieName, "/", $app->request->getHost(), $cookieSSL, true);
    $app->redirect("/");
});

// Admin
$app->map("/controlpanel(/:subPage)/", function ($subPage = null) use ($app){
    (new \ProjectRena\Controller\ControlPanelController($app))->index($subPage);
})->via("POST", "GET");

// Search
$app->map("/search(/:term).json", function ($searchTerm = null) use ($app){
    var_dump($app->Search->search($searchTerm));
})->via("POST", "GET");

// API
$app->group("/api", function () use ($app){
    // Data for a character
    $app->group("/character", function() use ($app) {
        $app->get("/information/:characterID/", function($characterID) use ($app) {
            (new \ProjectRena\Controller\APIController($app))->characterInformation($characterID);
        });
    });

    // Data for a corporation
    $app->group("/corporation", function() use ($app) {
        $app->get("/", function() use ($app){
            echo "ermergerd";
        });
        $app->get("/information/:corporationID/", function($corporationID) use ($app){
            (new \ProjectRena\Controller\APIController($app))->corporationInformation($corporationID);
        });
        $app->get("/members/:corporationID/", function($corporationID) use ($app){
            (new \ProjectRena\Controller\APIController($app))->corporationMembers($corporationID);
        });
    });

    // Data for an alliance
    $app->group("/alliance", function() use ($app){
        $app->get("/information/:allianceID/", function($allianceID) use ($app){
            (new \ProjectRena\Controller\APIController($app))->allianceInformation($allianceID);
        });
        $app->get("/members/:allianceID/", function($allianceID) use ($app){
            (new \ProjectRena\Controller\APIController($app))->allianceMembers($allianceID);
        });
    });
});