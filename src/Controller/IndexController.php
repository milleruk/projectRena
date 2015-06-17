<?php

namespace ProjectRena\Controller;

class IndexController
{

    public function index($app)
    {
        $app->render('index.twig');
    }
}
