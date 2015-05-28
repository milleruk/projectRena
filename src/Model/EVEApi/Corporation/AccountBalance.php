<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class AccountBalance
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class AccountBalance {
	/**
	 * @var int
	 */
	public static $accessMask = 1;

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
		$result = $pheal->AccountBalance(array("characterID" => $characterID))->toArray();

		return $result;
	}
}