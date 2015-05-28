<?php


namespace ProjectRena\Model;


use ProjectRena\Lib\Database;

/**
 * Class ApiKeys
 *
 * @package ProjectRena\Model
 */
class ApiKeys {
	/**
	 * @param $apiKeyID
	 * @param $vCode
	 * @param null $userID
	 *
	 * @return bool|int|string
	 */
	public static function addAPIKey($apiKeyID, $vCode, $userID = NULL)
	{
		return Database::execute("INSERT INTO apiKeys (keyID, vCode, userID) VALUES (:keyID, :vCode, :userID)", array(":keyID" => $apiKeyID, ":vCode" => $vCode, ":userID" => $userID));
	}

	/**
	 * @param $apiKeyID
	 *
	 * @return array
	 */
	public static function getAPIKey($apiKeyID)
	{
		return Database::queryRow("SELECT * FROM apiKeys WHERE keyID = :keyID", array(":keyID" => $apiKeyID));
	}

	/**
	 * @param $apiKeyID
	 * @param $vCode
	 * @param $userID
	 *
	 * @return bool|int|string
	 */
	public static function updateAPIKey($apiKeyID, $vCode, $userID)
	{
		return Database::execute("INSERT INTO apiKeys (keyID, vCode, userID) VALUES (:keyID, :vCode, :userID) ON DUPLICATE UPDATE keyID = :keyID, vCode = :vCode, userID = :userID", array(":keyID" => $apiKeyID, ":vCode" => $vCode, ":userID" => $userID));
	}

	/**
	 * @param $apiKeyID
	 *
	 * @return bool|int|string
	 */
	public static function deleteAPIKey($apiKeyID)
	{
		return Database::execute("DELETE FROM apiKeys WHERE keyID = :keyID", array(":keyID" => $apiKeyID));
	}
}