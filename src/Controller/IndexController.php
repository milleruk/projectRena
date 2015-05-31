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

    public function hello()
    {
        $this->app->render('index.twig');
    }

    public function helloName($name)
    {
        $this->app->render('index.twig', array('name' => $name));
    }
}
