<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class ContractBids
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class ContractBids {
	/**
	 * @var int
	 */
	public $accessMask = 8388608;

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
		$result = $pheal->ContractBids(array("characterID" => $characterID))->toArray();

		return $result;
	}

}