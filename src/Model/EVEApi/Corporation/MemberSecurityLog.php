<?php


namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class MemberSecurityLog
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class MemberSecurityLog {
	/**
	 * @var int
	 */
	public $accessMask = 1024;

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode, $characterID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->MemberSecurityLog(array("characterID" => $characterID))->toArray();

		return $result;
	}
}