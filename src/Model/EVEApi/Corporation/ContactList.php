<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class ContactList
 *
 * @package ProjectRena\Model\EVEApi\Corporation
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
		$pheal->scope = "Corp";
		$result = $pheal->ContactList(array("characterID" => $characterID))->toArray();

		return $result;
	}

}