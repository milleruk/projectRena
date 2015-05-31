<?php
namespace ProjectRena\Model;

use ProjectRena\RenaApp;

/**
 * Class Users
 *
 * @package ProjectRena\Model
 */
class Users
{
    /**
     * @var RenaApp
     */
    private $app;
    /**
     * @var \ProjectRena\Lib\Service\Database
     */
    private $db;

    /**
     * @param RenaApp $app
     */
    function __construct(RenaApp $app)
    {
        $this->app = $app;
        $this->db = $this->app->db;
    }

    /**
     * @param $userID
     *
     * @return array
     */
    public function getUserByID($userID)
    {
        return $this->db->queryRow("SELECT * FROM users WHERE id = :userID", array(":userID" => $userID));
    }

    /**
     * @param $characterName
     *
     * @return array
     */
    public function getUserByName($characterName)
    {
        return $this->db->queryRow("SELECT * FROM users WHERE characterName = :characterName", array(":characterName" => $characterName));
    }

    /**
     * @param $characterName
     * @param $characterID
     * @param $characterOwnerHash
     *
     * @return bool|int|string returns ID of inserted character
     */
    public function createUserWithCrest($characterName, $characterID, $characterOwnerHash)
    {
        if (!$this->db->queryField("SELECT id FROM users WHERE characterName = :characterName", "id", array(":characterName" => $characterName))) {
            return $this->db->execute("INSERT INTO users (characterName, characterID, characterOwnerHash) VALUE (:characterName, :characterID, :characterOwnerHash)",
                array(":characterName"      => $characterName,
                      ":characterID"        => $characterID,
                      ":characterOwnerHash" => $characterOwnerHash
                ), true);
        }
        return false;
    }

    public function setUserAutoLoginHash($userID, $hash)
    {
        return $this->db->execute("UPDATE users SET loginHash = :hash WHERE id = :userID", array(":hash" => $hash, ":userID" => $userID));
    }
}