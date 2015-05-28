<?php


namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class CharacterID
 *
 * @package ProjectRena\Model\EVEApi\EVE
 */
class CharacterID {
	/**
	 * @var int
	 */
	public static $accessMask = null;

	/**
	 * @param array $characterNames
	 *
	 * @return mixed
	 */
	public static function getData($characterNames = array())
	{
		$pheal = PhealLoader::loadPheal();
		$pheal->scope = "EVE";
		$result = $pheal->CharacterID(array("names" => implode(",", $characterNames)))->toArray();

		return $result;
	}
}