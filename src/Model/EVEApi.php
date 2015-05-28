<?php

namespace ProjectRena\Model\EVEApi;

/**
 * Class EVEApi
 *
 * @package ProjectRena\Model\EVEApi
 */
/**
 * Class EVEApi
 *
 * @package ProjectRena\Model\EVEApi
 */
class EVEApi {
	/**
	 * @return mixed
	 */
	public static function CallList() {
		$return = new \ProjectRena\Model\EVEApi\API\CallList();
		return $return->getData();
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @return mixed
	 */
	public static function APIKeyInfo($apiKey, $vCode) {
		$return = new \ProjectRena\Model\EVEApi\Account\APIKeyInfo();
		return $return->getData($apiKey, $vCode);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @return mixed
	 */
	public static function AccountStatus($apiKey, $vCode) {
		$return = new \ProjectRena\Model\EVEApi\Account\AccountStatus();
		return $return->getData($apiKey, $vCode);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @return mixed
	 */
	public static function Characters($apiKey, $vCode) {
		$return = new \ProjectRena\Model\EVEApi\Account\Characters();
		return $return->getData($apiKey, $vCode);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charAccountBalance($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\AccountBalance();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charAssetList($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\AssetList();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charBlueprints($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\Blueprints();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param array $eventIDs
	 *
	 * @return mixed
	 */
	public static function charCalendarEventAttendees($apiKey, $vCode, $characterID, $eventIDs = array()) {
		$return = new \ProjectRena\Model\EVEApi\Character\CalendarEventAttendees();
		return $return->getData($apiKey, $vCode, $characterID, $eventIDs = array());
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charCharacterSheet($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\CharacterSheet();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charContactList($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\ContactList();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charContactNotifications($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\ContactNotifications();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charContractBids($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\ContractBids();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param $contractID
	 *
	 * @return mixed
	 */
	public static function charContractItems($apiKey, $vCode, $characterID, $contractID) {
		$return = new \ProjectRena\Model\EVEApi\Character\ContractItems();
		return $return->getData($apiKey, $vCode, $characterID, $contractID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param null $contractID
	 *
	 * @return mixed
	 */
	public static function charContracts($apiKey, $vCode, $characterID, $contractID = null) {
		$return = new \ProjectRena\Model\EVEApi\Character\Contracts();
		return $return->getData($apiKey, $vCode, $characterID, $contractID = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charFacWarStats($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\FacWarStats();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charIndustryJobs($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\IndustryJobs();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charIndustryJobsHistory($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\IndustryJobsHistory();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param null $fromID
	 * @param null $rowCount
	 *
	 * @return mixed
	 */
	public static function charKillMails($apiKey, $vCode, $characterID, $fromID = null, $rowCount = null) {
		$return = new \ProjectRena\Model\EVEApi\Character\KillMails();
		return $return->getData($apiKey, $vCode, $characterID, $fromID = null, $rowCount = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param array $ids
	 *
	 * @return mixed
	 */
	public static function charLocations($apiKey, $vCode, $characterID, $ids = array()) {
		$return = new \ProjectRena\Model\EVEApi\Character\Locations();
		return $return->getData($apiKey, $vCode, $characterID, $ids = array());
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param array $ids
	 *
	 * @return mixed
	 */
	public static function charMailBodies($apiKey, $vCode, $characterID, $ids = array()) {
		$return = new \ProjectRena\Model\EVEApi\Character\MailBodies();
		return $return->getData($apiKey, $vCode, $characterID, $ids = array());
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charMailMessages($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\MailMessages();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charMailingLists($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\MailingLists();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param null $orderID
	 *
	 * @return mixed
	 */
	public static function charMarketOrders($apiKey, $vCode, $characterID, $orderID = null) {
		$return = new \ProjectRena\Model\EVEApi\Character\MarketOrders();
		return $return->getData($apiKey, $vCode, $characterID, $orderID = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charMedals($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\Medals();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param array $ids
	 *
	 * @return mixed
	 */
	public static function charNotificationTexts($apiKey, $vCode, $characterID, $ids = array()) {
		$return = new \ProjectRena\Model\EVEApi\Character\NotificationTexts();
		return $return->getData($apiKey, $vCode, $characterID, $ids = array());
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charNotifications($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\Notifications();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charPlanetaryColonies($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\PlanetaryColonies();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param $planetID
	 *
	 * @return mixed
	 */
	public static function charPlanetaryLinks($apiKey, $vCode, $characterID, $planetID) {
		$return = new \ProjectRena\Model\EVEApi\Character\PlanetaryLinks();
		return $return->getData($apiKey, $vCode, $characterID, $planetID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param $planetID
	 *
	 * @return mixed
	 */
	public static function charPlanetaryPins($apiKey, $vCode, $characterID, $planetID) {
		$return = new \ProjectRena\Model\EVEApi\Character\PlanetaryPins();
		return $return->getData($apiKey, $vCode, $characterID, $planetID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param $planetID
	 *
	 * @return mixed
	 */
	public static function charPlanetaryRoutes($apiKey, $vCode, $characterID, $planetID) {
		$return = new \ProjectRena\Model\EVEApi\Character\PlanetaryRoutes();
		return $return->getData($apiKey, $vCode, $characterID, $planetID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charResearch($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\Research();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charSkillInTraining($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\SkillInTraining();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charSkillQueue($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\SkillQueue();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charStandings($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\Standings();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function charUpcomingCalendarEvents($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Character\UpcomingCalendarEvents();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param int $accountKey
	 * @param null $fromID
	 * @param null $rowCount
	 *
	 * @return mixed
	 */
	public static function charWalletJournal($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null) {
		$return = new \ProjectRena\Model\EVEApi\Character\WalletJournal();
		return $return->getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param int $accountKey
	 * @param null $fromID
	 * @param null $rowCount
	 *
	 * @return mixed
	 */
	public static function charWalletTransactions($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null) {
		$return = new \ProjectRena\Model\EVEApi\Character\WalletTransactions();
		return $return->getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpAccountBalance($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\AccountBalance();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpAssetList($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\AssetList();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpBlueprints($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\Blueprints();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpContactList($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\ContactList();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpContainerLog($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\ContainerLog();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpContractBids($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\ContractBids();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param $contractID
	 *
	 * @return mixed
	 */
	public static function corpContractItems($apiKey, $vCode, $characterID, $contractID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\ContractItems();
		return $return->getData($apiKey, $vCode, $characterID, $contractID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param null $contractID
	 *
	 * @return mixed
	 */
	public static function corpContracts($apiKey, $vCode, $characterID, $contractID = null) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\Contracts();
		return $return->getData($apiKey, $vCode, $characterID, $contractID = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param null $corporationID
	 *
	 * @return mixed
	 */
	public static function corpCorporationSheet($apiKey, $vCode, $corporationID = null) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\CorporationSheet();
		return $return->getData($apiKey, $vCode, $corporationID = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpCustomsOffices($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\CustomsOffices();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpFacWarStats($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\FacWarStats();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @return mixed
	 */
	public static function corpFacilities($apiKey, $vCode) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\Facilities();
		return $return->getData($apiKey, $vCode);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpIndustryJobs($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\IndustryJobs();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpIndustryJobsHistory($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\IndustryJobsHistory();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param null $fromID
	 * @param null $rowCount
	 *
	 * @return mixed
	 */
	public static function corpKillMails($apiKey, $vCode, $fromID = null, $rowCount = null) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\KillMails();
		return $return->getData($apiKey, $vCode, $fromID = null, $rowCount = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param array $ids
	 *
	 * @return mixed
	 */
	public static function corpLocations($apiKey, $vCode, $characterID, $ids = array()) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\Locations();
		return $return->getData($apiKey, $vCode, $characterID, $ids = array());
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param null $orderID
	 *
	 * @return mixed
	 */
	public static function corpMarketOrders($apiKey, $vCode, $characterID, $orderID = null) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\MarketOrders();
		return $return->getData($apiKey, $vCode, $characterID, $orderID = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpMedals($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\Medals();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpMemberMedals($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\MemberMedals();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpMemberSecurity($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\MemberSecurity();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpMemberSecurityLog($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\MemberSecurityLog();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param int $extended
	 *
	 * @return mixed
	 */
	public static function corpMemberTracking($apiKey, $vCode, $extended = 0) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\MemberTracking();
		return $return->getData($apiKey, $vCode, $extended = 0);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpOutpostList($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\OutpostList();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param $itemID
	 *
	 * @return mixed
	 */
	public static function corpOutpostServiceDetail($apiKey, $vCode, $characterID, $itemID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\OutpostServiceDetail();
		return $return->getData($apiKey, $vCode, $characterID, $itemID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpShareholders($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\Shareholders();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpStandings($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\Standings();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $itemID
	 *
	 * @return mixed
	 */
	public static function corpStarbaseDetail($apiKey, $vCode, $itemID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\StarbaseDetail();
		return $return->getData($apiKey, $vCode, $itemID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 *
	 * @return mixed
	 */
	public static function corpStarbaseList($apiKey, $vCode) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\StarbaseList();
		return $return->getData($apiKey, $vCode);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 *
	 * @return mixed
	 */
	public static function corpTitles($apiKey, $vCode, $characterID) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\Titles();
		return $return->getData($apiKey, $vCode, $characterID);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param int $accountKey
	 * @param null $fromID
	 * @param null $rowCount
	 *
	 * @return mixed
	 */
	public static function corpWalletJournal($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\WalletJournal();
		return $return->getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null);
	}

	/**
	 * @param $apiKey
	 * @param $vCode
	 * @param $characterID
	 * @param int $accountKey
	 * @param null $fromID
	 * @param null $rowCount
	 *
	 * @return mixed
	 */
	public static function corpWalletTransactions($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null) {
		$return = new \ProjectRena\Model\EVEApi\Corporation\WalletTransactions();
		return $return->getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null);
	}

	/**
	 * @return mixed
	 */
	public static function AllianceList() {
		$return = new \ProjectRena\Model\EVEApi\EVE\AllianceList();
		return $return->getData();
	}

	/**
	 * @param array $characterIDs
	 *
	 * @return mixed
	 */
	public static function CharacterAffiliation($characterIDs = array()) {
		$return = new \ProjectRena\Model\EVEApi\EVE\CharacterAffiliation();
		return $return->getData($characterIDs = array());
	}

	/**
	 * @param array $characterNames
	 *
	 * @return mixed
	 */
	public static function CharacterID($characterNames = array()) {
		$return = new \ProjectRena\Model\EVEApi\EVE\CharacterID();
		return $return->getData($characterNames = array());
	}

	/**
	 * @param $characterID
	 * @param null $apiKey
	 * @param null $vCode
	 *
	 * @return mixed
	 */
	public static function CharacterInfo($characterID, $apiKey = null, $vCode = null) {
		$return = new \ProjectRena\Model\EVEApi\EVE\CharacterInfo();
		return $return->getData($characterID, $apiKey = null, $vCode = null);
	}

	/**
	 * @param array $characterIDs
	 *
	 * @return mixed
	 */
	public static function CharacterName($characterIDs = array()) {
		$return = new \ProjectRena\Model\EVEApi\EVE\CharacterName();
		return $return->getData($characterIDs = array());
	}

	/**
	 * @return mixed
	 */
	public static function ConquerableStationList() {
		$return = new \ProjectRena\Model\EVEApi\EVE\ConquerableStationList();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function ErrorList() {
		$return = new \ProjectRena\Model\EVEApi\EVE\ErrorList();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function FacWarStats() {
		$return = new \ProjectRena\Model\EVEApi\EVE\FacWarStats();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function FacWarTopStats() {
		$return = new \ProjectRena\Model\EVEApi\EVE\FacWarTopStats();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function RefTypes() {
		$return = new \ProjectRena\Model\EVEApi\EVE\RefTypes();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function SkillTree() {
		$return = new \ProjectRena\Model\EVEApi\EVE\SkillTree();
		return $return->getData();
	}

	/**
	 * @param array $typeIDs
	 *
	 * @return mixed
	 */
	public static function TypeName($typeIDs = array()) {
		$return = new \ProjectRena\Model\EVEApi\EVE\TypeName();
		return $return->getData($typeIDs = array());
	}

	/**
	 * @return mixed
	 */
	public static function FacWarSystems() {
		$return = new \ProjectRena\Model\EVEApi\Map\FacWarSystems();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function Jumps() {
		$return = new \ProjectRena\Model\EVEApi\Map\Jumps();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function Kills() {
		$return = new \ProjectRena\Model\EVEApi\Map\Kills();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function Sovereignty() {
		$return = new \ProjectRena\Model\EVEApi\Map\Sovereignty();
		return $return->getData();
	}

	/**
	 * @return mixed
	 */
	public static function ServerStatus() {
		$return = new \ProjectRena\Model\EVEApi\Server\ServerStatus();
		return $return->getData();
	}

};