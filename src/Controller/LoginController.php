<?php

namespace ProjectRena\Controller;

use ProjectRena\Lib\Service\baseConfig;
use ProjectRena\Model\OAuth\EVE;
use ProjectRena\Model\Users;
use ProjectRena\RenaApp;

/**
 * Class LoginController
 * @package ProjectRena\Controller
 */
class LoginController
{
    public function loginEVE($app)
    {
        // Instantiate the Eve Online service using the credentials, http client, storage mechanism for the token and profile scope
        $SSOInit = new EVE();
        $eveService = $SSOInit->init($app);
        if ($eveService->isGlobalRequestArgumentsPassed()) {
            $result = $eveService->retrieveAccessTokenByGlobReqArgs()->requestJSON('/oauth/verify');
            if ($result)
            {
                $characterID = $result["CharacterID"];
                $characterName = $result["CharacterName"];
                $characterOwnerHash = $result["CharacterOwnerHash"];

                // Insert the user to the table
                $userID = Users::createUserWithCrest($characterName, $characterID, $characterOwnerHash);

                // Set an auto login cookie
                $cookieName = baseConfig::getConfig("name", "cookies");
                $cookieSSL = baseConfig::getConfig("ssl", "cookies");
                $cookieTime = baseConfig::getConfig("time", "cookies");
                $cookieSecret = baseConfig::getConfig("secret", "cookies");
                $hash = md5($characterName.$cookieSecret);
                $expires = time() + $cookieTime;
                $app->setEncryptedCookie($cookieName, $hash, $expires, "/", $app->request->getHost(), $cookieSSL, true);

                // Update the auto login for the user with the hash that was created
                Users::setUserAutoLoginHash($userID, $hash);

                // Set the session
                $_SESSION["characterName"] = $characterName;
                $_SESSION["characterID"] = $characterID;
                $_SESSION["loggedin"] = true;

                // Redirect to the frontpage
                $app->redirect("/");
            }
        } else {
            $eveService->redirectToAuthorizationUri();
        }
    }
}
