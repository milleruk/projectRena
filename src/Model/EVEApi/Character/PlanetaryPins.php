<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class PlanetaryPins
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class PlanetaryPins {
	/**
	 * @var int
	 */
	public static $accessMask = 2;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param $planetID
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID, $planetID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$result = $pheal->PlanetaryPins(array("characterID" => $characterID, "planetID" => $planetID))->toArray();

		return $result;
	}

}