<?php


namespace ProjectRena\Model\EVEApi\Account;

use ProjectRena\Lib\PhealLoader;

/**
 * Class Characters
 *
 * @package ProjectRena\Model\EVEApi\Account
 */
class Characters {
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
		$result = $pheal->Characters()->toArray();

		return $result;
	}
}