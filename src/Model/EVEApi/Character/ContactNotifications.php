<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class ContactNotifications
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class ContactNotifications {
	/**
	 * @var int
	 */
	public $accessMask = 32;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode, $characterID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$result = $pheal->ContactNotifications(array("characterID" => $characterID))->toArray();

		return $result;
	}

}