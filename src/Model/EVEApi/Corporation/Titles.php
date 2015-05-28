<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Titles
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class Titles {
	/**
	 * @var int
	 */
	public $accessMask = 4194304;

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode, $characterID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->Titles(array("characterID" => $characterID))->toArray();

		return $result;
	}
}