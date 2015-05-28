<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class ContractBids
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class ContractBids {
	/**
	 * @var int
	 */
	public static $accessMask = 67108864;

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
		$pheal->scope = "Char";
		$result = $pheal->ContractBids(array("characterID" => $characterID))->toArray();

		return $result;
	}

}