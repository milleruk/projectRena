<?php


namespace ProjectRena\Model\EVEApi\Character;


use ProjectRena\Lib\PhealLoader;

/**
 * Class UpcomingCalendarEvents
 *
 * @package ProjectRena\Model\EVEApi\Character
 */
class UpcomingCalendarEvents {
	/**
	 * @var int
	 */
	public static $accessMask = 1048576;

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function getData($apiKey, $vCode, $characterID)
	{
		$pheal = PhealLoader::loadPheal($apiKey, $vCode);
		$pheal->scope = "Char";
		$result = $pheal->UpcomingCalendarEvents(array("characterID" => $characterID))->toArray();

		return $result;
	}

}