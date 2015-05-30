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
        $this->config = $app->renaConfig;
    }

    public function loginEVE()
    {
        $currentUri = $this->app->request->getUrl().$this->app->request->getPath();
        $serviceFactory = new ServiceFactory();

        // Init the session storage
        $storage = new Session();

        // Setup the credentials
        $credentials = new Credentials(
            $this->config->getConfig('clientID', 'crestSSO'),
            $this->config->getConfig('secretKey', 'crestSSO'),
            $currentUri
        );

        // Instantiate the Eve Online service using the credentials, http client, storage mechanism for the token and profile scope
        $eveService = $serviceFactory->createService('EveOnline', $credentials, $storage, array());

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
            echo "<a href='$currentUri?go=go'>Login with Eve Online!</a>";
        }
    }
}
