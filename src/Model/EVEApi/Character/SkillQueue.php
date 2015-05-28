<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class SkillQueue
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class SkillQueue {
	/**
	 * @var int
	 */
	public static $accessMask = 262144;

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
		$result = $pheal->SkillQueue(array("characterID" => $characterID))->toArray();

		return $result;
	}

}