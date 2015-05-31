<?php

namespace ProjectRena\Controller;

use ProjectRena\RenaApp;

class IndexController
{
    /**
     * @var RenaApp
     */
    protected $app;

    /**
     * @param RenaApp $app
     */
    public function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    public function index()
    {
        $this->app->render('index.twig');
    }
}
