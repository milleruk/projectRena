<?php


namespace ProjectRena\Model\EVEApi\Server;

use ProjectRena\Lib\PhealLoader;

/**
 * Class ServerStatus
 *
 * @package ProjectRena\Model\EVEApi\Server
 */
class ServerStatus {
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
		$pheal->scope = "Server";
		$result = $pheal->ServerStatus()->toArray();

		return $result;
	}
}