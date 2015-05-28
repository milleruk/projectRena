<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Notifications
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class Notifications {
	/**
	 * @var int
	 */
	public $accessMask = 16384;

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
		$result = $pheal->Notifications(array("characterID" => $characterID))->toArray();

		return $result;
	}

}