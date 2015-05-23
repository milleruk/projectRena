<?php

// set timezone for timestamps etc
date_default_timezone_set('UTC');

// Init the config array
$config = array();

// Database
$config["database"] = array(
	"host" => "",
	"username" => "",
	"password" => "",
	"name" => "",
	"persistent" => true,
	"emulatePrepares" => true,
	"useBufferedQuery" => true
);

// Slim
$config["slim"] = array(
	"templates.path" => __DIR__ . "/view/",
);

// Twig
$config["twig"] = array(
    "charset" => "utf-8",
    "cache" => __DIR__ . "/cache/templates/",
    "auto_reload" => true,
    "strict_variables" => false,
    "autoescape" => true
);