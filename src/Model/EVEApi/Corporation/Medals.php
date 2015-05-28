<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Medals
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class Medals {
	/**
	 * @var int
	 */
	public $accessMask = 8192;

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
		$pheal->scope = "Corp";
		$result = $pheal->Medals(array("characterID" => $characterID))->toArray();

		return $result;
	}

}