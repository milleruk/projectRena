<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class FacWarStats
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class FacWarStats {
	/**
	 * @var int
	 */
	public $accessMask = 64;

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
		$result = $pheal->FacWarStats(array("characterID" => $characterID))->toArray();

		return $result;
	}

}