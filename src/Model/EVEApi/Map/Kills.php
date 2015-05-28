<?php


namespace ProjectRena\Model\EVEApi\Map;

use ProjectRena\Lib\PhealLoader;

/**
 * Class Kills
 *
 * @package ProjectRena\Model\EVEApi\Map
 */
class Kills {
	/**
	 * @var int
	 */
	public $accessMask = null;

	/**
	 * @return mixed
	 */
	public function getData()
	{
		$pheal = PhealLoader::loadPheal();
		$pheal->scope = "Map";
		$result = $pheal->Kills()->toArray();

		return $result;
	}
}