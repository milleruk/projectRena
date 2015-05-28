<?php


namespace ProjectRena\Model\EVEApi\Account;

/**
 * Class Characters
 *
 * @package ProjectRena\Model\EVEApi\Account
 */
/**
 * Class Characters
 *
 * @package ProjectRena\Model\EVEApi\Account
 */
class Characters {
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
		$result = $pheal->Characters()->toArray();

		return $result;
	}
}