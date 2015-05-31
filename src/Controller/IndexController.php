<?php

namespace ProjectRena\Controller;

use ProjectRena\RenaApp;

class IndexController
{
    public static function index()
    {
        $this->app->render('index.twig');
    }
}
