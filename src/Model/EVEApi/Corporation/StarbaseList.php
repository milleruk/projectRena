<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class StarbaseList
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class StarbaseList {
	/**
	 * @var int
	 */
	public static $accessMask = 524288;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->StarbaseList()->toArray();

		return $result;
	}
}