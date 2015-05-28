<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class ContactList
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class ContactList {
	/**
	 * @var int
	 */
	public static $accessMask = 16;

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
		$result = $pheal->ContactList(array("characterID" => $characterID))->toArray();

		return $result;
	}

}