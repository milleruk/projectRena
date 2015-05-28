<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class OutpostList
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class OutpostList {
	/**
	 * @var int
	 */
	public $accessMask = 16384;

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
		$result = $pheal->OutpostList(array("characterID" => $characterID))->toArray();

		return $result;
	}
}