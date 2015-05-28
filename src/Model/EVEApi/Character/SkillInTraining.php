<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class SkillInTraining
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class SkillInTraining {
	/**
	 * @var int
	 */
	public static $accessMask = 131072;

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
		$result = $pheal->SkillInTraining(array("characterID" => $characterID))->toArray();

		return $result;
	}

}