<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class KillMails
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class KillMails {
	/**
	 * @var int
	 */
	public $accessMask = 256;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param null $fromID
	 * @param null $rowCount
	 *
	 * @return mixed
	 * @internal param $characterID
	 */
	public function getData($apiKey, $vCode, $fromID = null, $rowCount = null)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";

		$requestArray = array();
		if(isset($fromID))
			$requestArray["fromID"] = $fromID;
		if(isset($rowCount))
			$requestArray["rowCount"] = $rowCount;
		$result = $pheal->KillMails($requestArray)->toArray();

		return $result;
	}

}