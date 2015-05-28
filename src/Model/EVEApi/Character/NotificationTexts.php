<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class NotificationTexts
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class NotificationTexts {
	/**
	 * @var int
	 */
	public static $accessMask = 32768;

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
		$result = $pheal->NotificationTexts(array("characterID" => $characterID, "IDs" => implode(",", $ids)))->toArray();

		return $result;
	}

}