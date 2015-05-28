<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Medals
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class Medals {
	/**
	 * @var int
	 */
	public static $accessMask = 8192;

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
		$pheal->scope = "Char";
		$result = $pheal->Medals(array("characterID" => $characterID))->toArray();

		return $result;
	}

}