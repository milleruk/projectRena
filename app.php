<?php
// Include bootstrap
use Slim\Views\Twig;
use Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware;

// Error display
ini_set("display_errors", 1);
error_reporting(E_WARNING);

// Load the autoloader
if (file_exists(__DIR__ . "/vendor/autoload.php")) {
    require_once __DIR__ . "/vendor/autoload.php";
} else {
    throw new Exception("vendor/autoload.php not found, make sure you run composer install");
}

// Require the config
if (file_exists(__DIR__ . "/config/config.php")) {
    require_once __DIR__ . "/config/config.php";
} else {
    throw new Exception("config.php not found (you might wanna start by copying config_new.php)");
}

// Init Slim
$app = new \ProjectRena\RenaApp($config["slim"]);

// Session
$session = new SessionHandler();
session_set_save_handler($session, true);
session_cache_limiter(false);
session_start();

// Launch Whoops
$app->add(new WhoopsMiddleware());

// Load the translator
$translator = new \Symfony\Component\Translation\Translator("en_US", new \Symfony\Component\Translation\MessageSelector());
$translator->setFallbackLocales(array("en_US"));
$translator->addLoader("php", new \Symfony\Component\Translation\Loader\PhpFileLoader());
$languageFiles = glob(__DIR__ . "/lang/*.php");
foreach($languageFiles as $langFile)
    $translator->addResource("php", $langFile, str_replace(".php", "", basename($langFile)));

// Prepare view
$app->view(new Twig());
$app->view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
    new \Symfony\Bridge\Twig\Extension\TranslationExtension($translator)
);
$app->view->parserOptions = $config['twig'];

// Load the lib/Model loader
if (file_exists(__DIR__ . "/src/Loader.php")) {
    require_once __DIR__ . "/src/Loader.php";
} else {
    throw new Exception("Loader.php could not be found");
}

// load the additional configs
$configFiles = glob(__DIR__ . "/config/*.php");
foreach ($configFiles as $configFile) {
    require_once $configFile;
}

// Try and auto login the person
$app->Users->tryAutologin();

// Run app
$app->run();

/**
 * Var_dumps and dies, quicker than var_dump($input); die();
 *
 * @param $input
 */
function dd($input)
{
    var_dump($input);
    die();
}

/**
 * Quick access to rendering templates, json, xml and probably more down the line.
 *
 * @param string $templateFile
 * @param array $dataArray
 * @param null $status
 * @param string $contentType
 */
function render($templateFile, $dataArray = array(), $status = null, $contentType = null)
{
    $app = \ProjectRena\RenaApp::getInstance();
    $app->out->render($templateFile, $dataArray, $status, $contentType);
}