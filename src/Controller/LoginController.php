<?php

namespace ProjectRena\Controller;

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;
use ProjectRena\Model\Config;
use ProjectRena\RenaApp;

/**
 * Class LoginController
 * @todo get the instance of this horrible oauth implementation through DI
 * @package ProjectRena\Controller
 */
class LoginController
{
    protected $app;

    public function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    public function loginEVE()
    {
        $currentUri = $this->app->request->getUrl().$this->app->request->getPath();
        $serviceFactory = new ServiceFactory();

        // Init the session storage
        $storage = new Session();

        // Setup the credentials
        $credentials = new Credentials(
            Config::getConfig('clientID', 'crestSSO'),
            Config::getConfig('secretKey', 'crestSSO'),
            $currentUri
        );

        // Instantiate the Eve Online service using the credentials, http client, storage mechanism for the token and profile scope
        // @todo get rid of the error supression
        $eveService = $serviceFactory->createService('EveOnline', $credentials, @$storage, array());

        if ($eveService->isGlobalRequestArgumentsPassed()) {
            $result = $eveService->retrieveAccessTokenByGlobReqArgs()->requestJSON('/oauth/verify');
            // Do stuff with the data here, and log the user in...
            var_dump($result);
        } elseif (!empty($this->app->request->get('go')) && $this->app->request->get('go') == 'go') {
            $eveService->redirectToAuthorizationUri();
        } else {
            // @todo use templates!
            echo "<a href='$currentUri?go=go'>Login with Eve Online!</a>";
        }
    }
}
