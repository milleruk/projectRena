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
	public $accessMask = null;

	/**
	 * @return mixed
	 */
	public function getData()
	{
		$pheal = PhealLoader::loadPheal();
		$pheal->scope = "API";
		$result = $pheal->CallList()->toArray();

		return $result;
	}
}