<?php

// Cheatsheet: https://andreiabohner.files.wordpress.com/2014/06/slim.pdf
// Main route
$app->get("/", function() use ($app){
    var_dump($app->Db->query("SELECT 1"));
    echo "yay";
});
