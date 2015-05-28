<?php


namespace ProjectRena\Model\EVEApi\Map;

use ProjectRena\Lib\PhealLoader;

/**
 * Class FacWarSystems
 *
 * @package ProjectRena\Model\EVEApi\Map
 */
class FacWarSystems {
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
		$result = $pheal->FacWarSystems()->toArray();

		return $result;
	}
}