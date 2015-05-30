<?php

// Load twig
$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

// Get $twig
$twig = $app->view()->getEnvironment();

// Twig globals
$twig->addGlobal('test', 'test');
