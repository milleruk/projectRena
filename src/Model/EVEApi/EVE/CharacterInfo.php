<?php


namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class CharacterInfo
 *
 * @package ProjectRena\Model\EVEApi\EVE
 */
class CharacterInfo {
	/**
	 * @var int
	 */
	public static $accessMask = null;

	/**
	 * @param $characterID
	 * @param null $apiKey
	 * @param null $vCode
	 *
	 * @return mixed
	 */
	public static function getData($characterID, $apiKey = null, $vCode = null)
	{
		$pheal = PhealLoader::loadPheal();
		$pheal->scope = "EVE";
		$requestArray = array("characterID" => $characterID);

		if(isset($apiKey))
			$requestArray["apiKey"] = $apiKey;
		if(isset($vCode))
			$requestArray["vCode"] = $vCode;
		$result = $pheal->CharacterInfo($requestArray)->toArray();

		return $result;
	}
}