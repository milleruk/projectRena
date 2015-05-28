<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class OutpostServiceDetail
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class OutpostServiceDetail {
	/**
	 * @var int
	 */
	public $accessMask = 32768;

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param $itemID
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode, $characterID, $itemID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->OutpostServiceDetail(array("characterID" => $characterID, "itemID" => $itemID))->toArray();

		return $result;
	}
}