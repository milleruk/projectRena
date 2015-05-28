<?php


namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class RefTypes
 *
 * @package ProjectRena\Model\EVEApi\EVE
 */
class RefTypes {
	/**
	 * @var int
	 */
	public static $accessMask = null;

	/**
	 * @return mixed
	 */
	public static function getData()
	{
		$pheal = PhealLoader::loadPheal();
		$pheal->scope = "EVE";
		$result = $pheal->RefTypes()->toArray();

		return $result;
	}
}