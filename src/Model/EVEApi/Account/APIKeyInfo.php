<?php


namespace ProjectRena\Model\EVEApi\Account;


class APIKeyInfo {
	public static $accessMask = null;
	public static function getData($apiKey, $vCode)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Account";
		$result = $pheal->APIKeyInfo()->toArray();

		return $result;
	}
}