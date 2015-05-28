<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class ContractItems
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class ContractItems {
	/**
	 * @var int
	 */
	public static $accessMask = 8388608;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param $contractID
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID, $contractID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->ContractItems(array("characterID" => $characterID, "contractID" => $contractID))->toArray();

		return $result;
	}

}