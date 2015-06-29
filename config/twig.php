<?php

// Load twig
//use ProjectRena\Model\OAuth\EVE;

$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

// Get $twig
$twig = $app->view()->getEnvironment();

// Twig globals
$twig->addGlobal("LoggedIN", isset($_SESSION["loggedIn"]) ? true : false);

// CCP Image server
$twig->addGlobal("imageServer", $app->baseConfig->getConfig("imageServer", "ccp"));

// Character Settings
$twig->addGlobal("characterName", isset($_SESSION["characterName"]) ? $_SESSION["characterName"] : null);
$twig->addGlobal("characterID", isset($_SESSION["characterID"]) ? $_SESSION["characterID"] : null);

$characterInformation = array();
if(isset($_SESSION["characterID"]))
{
    $characterInformation = $app->characters->getAllByID($_SESSION["characterID"]);
    $characterInformation["corporation"] = $app->corporations->getAllByID($app->characters->getAllByID($_SESSION["characterID"])["corporationID"]);
    $characterInformation["alliance"] = $app->alliances->getAllByID($app->characters->getAllByID($_SESSION["characterID"])["allianceID"]);
    $characterInformation["groups"] = $app->UsersGroups->getGroup($app->Users->getUserByName($characterInformation["characterName"])["id"]);
}

$twig->addGlobal("charInfo", $characterInformation);

// EVE SSO URL
$twig->addGlobal("EVESSOURL", $app->EVEOAuth->LoginURL());