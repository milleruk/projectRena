<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Shareholders
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class Shareholders {
	/**
	 * @var int
	 */
	public static $accessMask = 65536;

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->Shareholders(array("characterID" => $characterID))->toArray();

		return $result;
	}
}