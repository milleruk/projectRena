<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class ContractItems
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class ContractItems {
	/**
	 * @var int
	 */
	public $accessMask = 67108864;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param $contractID
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode, $characterID, $contractID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$result = $pheal->ContractItems(array("characterID" => $characterID, "contractID" => $contractID))->toArray();

		return $result;
	}

}