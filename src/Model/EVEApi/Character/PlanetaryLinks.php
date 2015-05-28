<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class PlanetaryLinks
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class PlanetaryLinks {
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
		$result = $pheal->PlanetaryLinks(array("characterID" => $characterID, "planetID" => $planetID))->toArray();

		return $result;
	}

}