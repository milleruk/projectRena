<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class CorporationSheet
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class CorporationSheet {
	/**
	 * @var int
	 */
	public static $accessMask = 8;

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param null $corporationID
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $corporationID = null)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$requestArray = array();
		if(isset($corporationID))
			$requestArray["corporationID"] = $corporationID;
		$result = $pheal->CorporationSheet($requestArray)->toArray();

		return $result;
	}

}