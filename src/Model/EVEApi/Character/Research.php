<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class Research
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class Research {
	/**
	 * @var int
	 */
	public $accessMask = 65536;

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
		$pheal->scope = "Char";
		$result = $pheal->Research(array("characterID" => $characterID))->toArray();

		return $result;
	}

}