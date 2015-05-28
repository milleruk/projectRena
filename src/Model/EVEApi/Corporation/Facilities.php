<?php


namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class Facilities
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class Facilities {
	/**
	 * @var int
	 */
	public static $accessMask = 128;

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
		$result = $pheal->Facilities()->toArray();

		return $result;
	}
}