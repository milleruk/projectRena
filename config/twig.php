<?php

// Load twig
//use ProjectRena\Model\OAuth\EVE;

$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

// Get $twig
$twig = $app->view()->getEnvironment();

// Twig globals
$twig->addGlobal('LoggedIN', isset($_SESSION["loggedin"]) ? true : false);

// CCP Image server
$twig->addGlobal('imageServer', $app->baseConfig->getConfig("imageServer", "ccp"));

// Set the name and characterID
$twig->addGlobal('characterName', isset($_SESSION["characterName"]) ? $_SESSION["characterName"] : null);
$twig->addGlobal('characterID', isset($_SESSION["characterID"]) ? $_SESSION["characterID"] : null);

// EVE SSO URL
$twig->addGlobal('EVESSOURL', $app->EVEOAuth->LoginURL());
