<?php
namespace ProjectRena\Model\OAuth;

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;
use ProjectRena\RenaApp;

class EVE
{
    private $app;
    private $config;
    private $credentials;
    private $currentURI;
    private $eveServiceFactory;

    function __construct(RenaApp $app)
    {
        $this->app = $app;
        $this->config = $app->baseConfig;

        // Define the current url
        $this->currentURI = $app->request->getUrl().$this->config->getConfig("callBack", "crestsso");

        $serviceFactory = new ServiceFactory();

        $storage = new Session();

        $this->credentials = new Credentials(
            $this->config->getConfig('clientID', 'crestSSO'),
            $this->config->getConfig('secretKey', 'crestSSO'),
            $this->currentURI
        );

        $this->eveServiceFactory = $serviceFactory->createService('EveOnline', $this->credentials, $storage, array());
    }

    public function init()
    {
        return $this->eveServiceFactory;
    }

    public function returnAuthURI()
    {
        return $this->eveServiceFactory->getAuthorizationUri();
    }

    public function returnCurrentURI()
    {
        return $this->currentURI;
    }
}