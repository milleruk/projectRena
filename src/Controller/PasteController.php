<?php
namespace ProjectRena\Controller;

use ProjectRena\RenaApp;

class PasteController
{
    protected $app;
    private $config;

    public function __construct(RenaApp $app)
    {
        $this->app = $app;
        $this->config = $app->baseConfig;
    }

    public function pastePage()
    {

    }

    public function postPaste()
    {

    }

    public function showPaste()
    {

    }
}