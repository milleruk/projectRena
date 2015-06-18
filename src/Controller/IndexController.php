<?php

namespace ProjectRena\Controller;

class IndexController
{

    protected $app;
    function __construct($app)
    {
        $this->app = $app;
    }

    public function index()
    {
        $this->app->render('index.twig');
    }
}
