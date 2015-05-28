<?php


namespace ProjectRena\Model\EVEApi\Account;

/**
 * Class APIKeyInfo
 *
 * @package ProjectRena\Model\EVEApi\Account
 */
/**
 * Class APIKeyInfo
 *
 * @package ProjectRena\Model\EVEApi\Account
 */
class APIKeyInfo {
	/**
	 * @var null
	 */
	public static $accessMask = null;

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
		$result = $pheal->APIKeyInfo()->toArray();

		return $result;
	}
}