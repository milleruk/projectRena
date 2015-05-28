<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class ContainerLog
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class ContainerLog {
	/**
	 * @var int
	 */
	public $accessMask = 32;

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
		$result = $pheal->ContainerLog(array("characterID" => $characterID))->toArray();

		return $result;
	}
}