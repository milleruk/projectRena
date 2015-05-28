<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class AssetList
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class AssetList {
	/**
	 * @var int
	 */
	public static $accessMask = 2;

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
		$result = $pheal->AssetList(array("characterID" => $characterID))->toArray();

		return $result;
	}

}