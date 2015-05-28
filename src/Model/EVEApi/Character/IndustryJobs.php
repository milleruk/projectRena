<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class IndustryJobs
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class IndustryJobs {
	/**
	 * @var int
	 */
	public $accessMask = 128;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode, $characterID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$result = $pheal->IndustryJobs(array("characterID" => $characterID))->toArray();

		return $result;
	}

}