<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class FacWarStats
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class FacWarStats {
	/**
	 * @var int
	 */
	public static $accessMask = 64;

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
		$result = $pheal->FacWarStats(array("characterID" => $characterID))->toArray();

		return $result;
	}

}