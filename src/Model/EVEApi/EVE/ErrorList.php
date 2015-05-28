<?php


namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class ErrorList
 *
 * @package ProjectRena\Model\EVEApi\EVE
 */
class ErrorList {
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
		$result = $pheal->ErrorList()->toArray();

		return $result;
	}
}