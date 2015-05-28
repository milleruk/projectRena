<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Standings
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class Standings {
	/**
	 * @var int
	 */
	public $accessMask = 524288;

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
		$result = $pheal->Standings(array("characterID" => $characterID))->toArray();

		return $result;
	}

}