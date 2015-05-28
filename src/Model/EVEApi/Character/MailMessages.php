<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class MailMessages
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class MailMessages {
	/**
	 * @var int
	 */
	public $accessMask = 2048;

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
		$result = $pheal->MailMessages(array("characterID" => $characterID))->toArray();

		return $result;
	}

}