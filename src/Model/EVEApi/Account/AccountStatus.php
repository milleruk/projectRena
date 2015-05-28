<?php


namespace ProjectRena\Model\EVEApi\Account;

use ProjectRena\Lib\PhealLoader;

/**
 * Class AccountStatus
 *
 * @package ProjectRena\Model\EVEApi\Account
 */
class AccountStatus {
	/**
	 * @var int
	 */
	public static $accessMask = 33554432;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Account";
		$result = $pheal->accountStatus()->toArray();

		return $result;
	}
}