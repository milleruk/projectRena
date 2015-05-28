<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class MemberMedals
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class MemberMedals {
	/**
	 * @var int
	 */
	public static $accessMask = 4;

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
		$result = $pheal->MemberMedals(array("characterID" => $characterID))->toArray();

		return $result;
	}
}