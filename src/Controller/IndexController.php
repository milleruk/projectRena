<?php

namespace ProjectRena\Controller;

use ProjectRena\RenaApp;

class IndexController
{

    protected $app;
    function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    public function index()
    {
        var_dump($this->app->EVEEVEAllianceList->getData());
        $this->app->render('index.twig');
    }
}
