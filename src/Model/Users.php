<?php
namespace ProjectRena\Model;

use ProjectRena\Lib\Service\baseConfig;
use ProjectRena\Lib\Service\Database;
use ProjectRena\RenaApp;

/**
 * Class Users
 *
 * @package ProjectRena\Model
 */
class Users
{
    /**
     * @param $userID
     *
     * @return array
     */
    public static function getUserByID($userID)
    {
        return Database::queryRow("SELECT * FROM users WHERE id = :userID", array(":userID" => $userID));
    }

    /**
     * @param $characterName
     *
     * @return array
     */
    public static function getUserByName($characterName)
    {
        return Database::queryRow("SELECT * FROM users WHERE characterName = :characterName", array(":characterName" => $characterName));
    }

    /**
     * @param $hash
     *
     * @return array
     */
    public static function getUserDataByLoginHash($hash)
    {
        return Database::queryRow("SELECT * FROM users WHERE loginHash = :hash", array(":hash" => $hash));
    }

    /**
     * @param $characterName
     * @param $characterID
     * @param $characterOwnerHash
     *
     * @return int
     */
    public static function createUserWithCrest($characterName, $characterID, $characterOwnerHash)
    {
        $id = Database::queryField("SELECT id FROM users WHERE characterName = :characterName", "id", array(":characterName" => $characterName));
        if (!$id) {
            return Database::execute("INSERT INTO users (characterName, characterID, characterOwnerHash) VALUE (:characterName, :characterID, :characterOwnerHash)",
                array(":characterName"      => $characterName,
                      ":characterID"        => $characterID,
                      ":characterOwnerHash" => $characterOwnerHash
                ), true);
        }
        return $id;
    }

    /**
     * @param $userID
     * @param $hash
     *
     * @return bool|int|string
     */
    public static function setUserAutoLoginHash($userID, $hash)
    {
        return Database::execute("UPDATE users SET loginHash = :hash WHERE id = :userID", array(":hash" => $hash, ":userID" => $userID));
    }

    /**
     * Tries to autologin the person
     */
    public static function tryAutologin($app)
    {
        $cookieName = baseConfig::getConfig("name", "cookies");
        $cookieData = $app->getEncryptedCookie($cookieName, false);
        if(!empty($cookieData) && !isset($_SESSION["loggedin"]))
        {
            $userData = self::getUserDataByLoginHash($cookieData);
            if($userData)
            {
                $_SESSION["characterName"] = $userData["characterName"];
                $_SESSION["characterID"] = $userData["characterID"];
                $_SESSION["loggedin"] = true;

                // Using $app to redirect causes a weird bug in slim, so use a header Location: instead
                //header("Location: " . $this->app->request->getPath());
            }
        }
    }
}