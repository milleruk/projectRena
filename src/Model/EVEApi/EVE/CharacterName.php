<?php


namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class CharacterName
 *
 * @package ProjectRena\Model\EVEApi\EVE
 */
class CharacterName {
	/**
	 * @var int
	 */
	public $accessMask = null;

	/**
	 * @param array $characterIDs Max 250 characterIDs
	 *
	 * @return mixed
	 */
	public function getData($characterIDs = array())
	{
		$pheal = PhealLoader::loadPheal();
		$pheal->scope = "EVE";
		$result = $pheal->CharacterName(array("ids" => implode(",", $characterIDs)))->toArray();

		return $result;
	}
}