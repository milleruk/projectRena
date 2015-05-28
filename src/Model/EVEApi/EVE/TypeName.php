<?php


namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class TypeName
 *
 * @package ProjectRena\Model\EVEApi\EVE
 */
class TypeName {
	/**
	 * @var int
	 */
	public static $accessMask = null;

	/**
	 * @param array $typeIDs Max 250 IDs at a time
	 *
	 * @return mixed
	 */
	public static function getData($typeIDs = array())
	{
		$pheal = PhealLoader::loadPheal();
		$pheal->scope = "EVE";
		$result = $pheal->TypeName("ids" => implode(",", $typeIDs))->toArray();

		return $result;
	}
}