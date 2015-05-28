<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class MailBodies
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class MailBodies {
	/**
	 * @var int
	 */
	public static $accessMask = 512;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param array $ids
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID, $ids = array())
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$result = $pheal->MailBodies(array("characterID" => $characterID, "ids" => implode(",", $ids)))->toArray();

		return $result;
	}

}