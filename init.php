<?php

// Load the autoloader
require __DIR__.'/vendor/autoload.php';

// Require the config
require_once("config.php");

// Register autoloaders
spl_autoload_register("loadControllers");
spl_autoload_register("loadModels");

// Autoload Controllers
function loadControllers($controllerName)
{
	$baseDir = dirname(__FILE__);
	$fileName = "$baseDir/controllers/$controllerName.php";
	if (file_exists($fileName))
	{
		require_once $fileName;
		return;
	}
}

// Autoload Models
function loadModels($modelName)
{
	$baseDir = dirname(__FILE__);
	$fileName = "$baseDir/models/$modelName.php";
	if (file_exists($fileName))
	{
		require_once $fileName;
		return;
	}
}
