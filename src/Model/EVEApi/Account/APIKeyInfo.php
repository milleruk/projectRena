<?php


namespace ProjectRena\Model\EVEApi\Account;

use ProjectRena\Lib\PhealLoader;

/**
 * Class APIKeyInfo
 *
 * @package ProjectRena\Model\EVEApi\Account
 */
class APIKeyInfo {
	/**
	 * @var null
	 */
	public $accessMask = null;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Account";
		$result = $pheal->APIKeyInfo()->toArray();

		return $result;
	}
}