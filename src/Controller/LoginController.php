<?php


namespace ProjectRena\Controller;


use OAuth\ServiceFactory;
use ProjectRena\Model\Config;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class LoginController {
	public static function loginEVE(\Slim\Slim $app)
	{
		$currentUri = $app->request->getUrl() . $app->request->getPath();
		$serviceFactory = new ServiceFactory();

		// Init the session storage
		$storage = new Session();

		// Setup the credentials
		$credentials = new Credentials(
			Config::getConfig("clientID", "crestSSO"),
			Config::getConfig("secretKey", "crestSSO"),
			$currentUri
		);

		// Instantiate the Eve Online service using the credentials, http client, storage mechanism for the token and profile scope
		$eveService = $serviceFactory->createService("EveOnline", $credentials, @$storage, array());

		if($eveService->isGlobalRequestArgumentsPassed())
		{
			$result = $eveService->retrieveAccessTokenByGlobReqArgs()->requestJSON('/oauth/verify');
			// Do stuff with the data here, and log the user in...
			var_dump($result);
		}
		elseif(!empty($app->request->get("go")) && $app->request->get("go") == "go")
		{
			$eveService->redirectToAuthorizationUri();
		}
		else
		{
			echo "<a href='$currentUri?go=go'>Login with Eve Online!</a>";
		}
	}
}