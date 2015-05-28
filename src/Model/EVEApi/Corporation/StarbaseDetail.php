<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class StarbaseDetail
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class StarbaseDetail {
	/**
	 * @var int
	 */
	public static $accessMask = 131072;

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $itemID
	 *
	 * @return mixed
	 * @internal param $characterID
	 *
	 */
	public static function getData($apiKey, $vCode, $itemID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->StarbaseDetail(array("itemID" => $itemID))->toArray();

		return $result;
	}
}