<?php


namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class MemberSecurity
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class MemberSecurity {
	/**
	 * @var int
	 */
	public static $accessMask = 512;

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
		$result = $pheal->MemberSecurity(array("characterID" => $characterID))->toArray();

		return $result;
	}
}