<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Locations
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class Locations {
	/**
	 * @var int
	 */
	public $accessMask = 134217728;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param array $ids
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode, $characterID, $ids = array())
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$result = $pheal->Locations(array("characterID" => $characterID, "IDs" => implode(",", $ids)))->toArray();

		return $result;
	}

}