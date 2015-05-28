<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class MailingLists
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class MailingLists {
	/**
	 * @var int
	 */
	public static $accessMask = 1024;

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
		$result = $pheal->MailingLists(array("characterID" => $characterID))->toArray();

		return $result;
	}

}