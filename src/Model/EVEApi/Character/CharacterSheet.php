<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class CharacterSheet
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class CharacterSheet {
	/**
	 * @var int
	 */
	public static $accessMask = 8;

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
		$result = $pheal->CharacterSheet(array("characterID" => $characterID))->toArray();

		return $result;
	}

}