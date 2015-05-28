<?php


namespace ProjectRena\Model\EVEApi\Map;

use ProjectRena\Lib\PhealLoader;

/**
 * Class Sovereignty
 *
 * @package ProjectRena\Model\EVEApi\Map
 */
class Sovereignty {
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
		$pheal->scope = "Map";
		$result = $pheal->Sovereignty()->toArray();

		return $result;
	}
}