<?php

namespace ProjectRena\Controller;

use ProjectRena\RenaApp;

/**
 * Class LoginController
 * @package ProjectRena\Controller
 */
class LoginController
{
    protected $app;
    function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    public function loginEVE()
    {
        echo "NOPE, REWRITE BRUH";
    }
}
