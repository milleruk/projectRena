<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class MarketOrders
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class MarketOrders {
	/**
	 * @var int
	 */
	public static $accessMask = 4096;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 * @param null $orderID
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID, $orderID = null)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$requestArray = array("characterID" => $characterID);
		if(isset($orderID))
			$requestArray["orderID"] = $orderID;
		$result = $pheal->MarketOrders($requestArray)->toArray();

		return $result;
	}

}