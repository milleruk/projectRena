<?php

namespace ProjectRena\Controller;

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;
use ProjectRena\Model\Config;
use ProjectRena\RenaApp;

/**
 * Class LoginController
 * @package ProjectRena\Controller
 */
class LoginController
{
    protected $app;
    private $config;

    public function __construct(RenaApp $app)
    {
        $this->app = $app;
        $this->config = $app->baseConfig;
    }

    public function loginEVE()
    {
        // Instantiate the Eve Online service using the credentials, http client, storage mechanism for the token and profile scope
        $SSOInit = new \ProjectRena\Model\OAuth\EVE($this->app);
        $eveService = $SSOInit->init();

        if ($eveService->isGlobalRequestArgumentsPassed())
        {
            $result = $eveService->retrieveAccessTokenByGlobReqArgs()->requestJSON('/oauth/verify');
            // Do stuff with the data here, and log the user in...
            var_dump($result);
        }
        elseif(!empty($this->app->request->get('go')) && $this->app->request->get('go') == 'go')
        {
            $eveService->redirectToAuthorizationUri();
        }
        else
        {
            // @todo use templates!
            $uri = $SSOInit->returnCurrentURI();
            echo "<a href='$uri?go=go'>Login with Eve Online!</a>";
        }
    }
}
