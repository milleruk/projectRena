<?php

namespace ProjectRena\Controller;

use ProjectRena\Lib\baseConfig;
use ProjectRena\Model\OAuth\EVE;
use ProjectRena\Model\Users;

/**
 * Class LoginController
 * @package ProjectRena\Controller
 */
class LoginController
{
    protected $app;
    function __construct($app)
    {
        $this->app = $app;
    }

    public function loginEVE()
    {
        echo "NOPE, REWRITE BRUH";
    }
}
