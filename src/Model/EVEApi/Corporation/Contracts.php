<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Contracts
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class Contracts {
	/**
	 * @var int
	 */
	public $accessMask = 8388608;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param null $contractID
	 *
	 * @return mixed
	 */
	public function getData($apiKey, $vCode, $characterID, $contractID = null)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$requestArray = array("characterID" => $characterID);
		if(isset($contractID))
			$requestArray["contractID"] = $contractID;
		$result = $pheal->Contracts($requestArray)->toArray();

		return $result;
	}

}