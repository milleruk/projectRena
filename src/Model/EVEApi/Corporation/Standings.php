<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Standings
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class Standings {
	/**
	 * @var int
	 */
	public static $accessMask = 262144;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->Standings(array("characterID" => $characterID))->toArray();

		return $result;
	}

}