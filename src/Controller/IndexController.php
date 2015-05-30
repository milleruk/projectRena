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
        var_dump($this->app->eveapi->apiCallList());
        var_dump($this->app->db->query("SELECT 1"));
        $this->app->render('index.html');
    }

    public function helloName($name)
    {
        $this->app->render('index.html', array('name' => $name));
    }
}
