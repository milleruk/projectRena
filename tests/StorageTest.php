<?php
namespace ProjectRena;
require_once(__DIR__ . "/init.php");

/**
 * @backupGlobals disabled
 */
class StorageTest extends \PHPUnit_Framework_TestCase
{
    private $app;

    public function __construct()
    {
        $this->app = \ProjectRena\RenaApp::getInstance();
    }
}