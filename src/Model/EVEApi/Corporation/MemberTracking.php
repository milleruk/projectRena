<?php


namespace ProjectRena\Model\EVEApi\Corporation;


use ProjectRena\Lib\PhealLoader;

/**
 * Class MemberTracking
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class MemberTracking {
	/**
	 * @var int
	 */
	public $accessMask = 2048;

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param int $extended 1 For extended details, 0 for non extended details
	 *
	 * @return mixed
	 * @internal param $characterID
	 *
	 */
	public function getData($apiKey, $vCode, $extended = 0)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Corp";
		$result = $pheal->MemberTracking(array("extended" => $extended))->toArray();

		return $result;
	}
}