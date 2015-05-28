<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class WalletJournal
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class WalletJournal {
	/**
	 * @var int
	 */
	public static $accessMask = 2097152;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param int $accountKey
	 * @param null $fromID
	 * @param null $rowCount
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$requestArray = array("characterID" => $characterID, "accountKey" => $accountKey);
		if(isset($fromID))
			$requestArray["fromID"] = $fromID;
		if(isset($rowCount))
			$requestArray["rowCount"] = $rowCount;

		$result = $pheal->WalletJournal($requestArray)->toArray();

		return $result;
	}

}