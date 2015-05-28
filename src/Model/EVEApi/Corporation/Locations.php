<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Locations
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class Locations {
	/**
	 * @var int
	 */
	public static $accessMask = 16777216;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param array $ids
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID, $ids = array())
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->Locations(array("characterID" => $characterID, "IDs" => implode(",", $ids)))->toArray();

		return $result;
	}

}