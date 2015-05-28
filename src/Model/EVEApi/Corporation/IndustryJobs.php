<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class IndustryJobs
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class IndustryJobs {
	/**
	 * @var int
	 */
	public static $accessMask = 128;

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
		$result = $pheal->IndustryJobs(array("characterID" => $characterID))->toArray();

		return $result;
	}

}