<?php
namespace ProjectRena\Model\OAuth;

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;
use ProjectRena\Lib\Service\baseConfig;

class EVE
{
    private static $currentURI;

    public static function init($app)
    {
        // Define the current url
        self::$currentURI = $app->request->getUrl() . baseConfig::getConfig("callBack", "crestsso");

        $serviceFactory = new ServiceFactory();

        $storage = new Session();

        $credentials = new Credentials(
            baseConfig::getConfig('clientID', 'crestSSO'),
            baseConfig::getConfig('secretKey', 'crestSSO'),
            self::$currentURI
        );

        return $eveServiceFactory = $serviceFactory->createService('EveOnline', $credentials, $storage, array());
    }

    public static function returnAuthURI($app)
    {
        $esf = self::init($app);
        return $esf->getAuthorizationUri();
    }

    public static function returnCurrentURI($app)
    {
        self::init($app);
        return self::$currentURI;
    }
}