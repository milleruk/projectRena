<?php


namespace ProjectRena\Model\EVEApi\Account;


class Characters {
	public static $accessMask = null;
	public static function getData($apiKey, $vCode)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Account";
		$result = $pheal->Characters()->toArray();

		return $result;
	}
}