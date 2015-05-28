<?php


namespace ProjectRena\Model\EVEApi\API;

use ProjectRena\Lib\PhealLoader;

/**
 * Class CallList
 *
 * @package ProjectRena\Model\EVEApi\API
 */
class CallList {
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
		$pheal->scope = "API";
		$result = $pheal->CallList()->toArray();

		return $result;
	}
}