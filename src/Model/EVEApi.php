<?php

namespace ProjectRena\Model;

use ProjectRena\RenaApp;

/**
 * Class EVEApi.
 */
class EVEApi
{
    /**
     * @var
     */
    public $app;

    /**
     * @var
     */
    public $pheal;

    /**
     * @param $app
     */
    function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public function apiCallList()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\API\CallList($this->app);
        return $return->getData();
    }

    /**
     * @param $apiKey
     * @param $vCode
     *
     * @return mixed
     */
    public function accountAPIKeyInfo($apiKey, $vCode)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Account\APIKeyInfo($this->app);

        return $return->getData($apiKey, $vCode);
    }

    /**
     * @param $apiKey
     * @param $vCode
     *
     * @return mixed
     */
    public function accountAccountStatus($apiKey, $vCode)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Account\AccountStatus($this->app);

        return $return->getData($apiKey, $vCode);
    }

    /**
     * @param $apiKey
     * @param $vCode
     *
     * @return mixed
     */
    public function accountCharacters($apiKey, $vCode)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Account\Characters($this->app);

        return $return->getData($apiKey, $vCode);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charAccountBalance($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\AccountBalance($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charAssetList($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\AssetList($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charBlueprints($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\Blueprints($this->app);

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
    public function charCalendarEventAttendees($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $eventIDs = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\CalendarEventAttendees($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $eventIDs = array());
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charCharacterSheet($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\CharacterSheet($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charContactList($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\ContactList($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charContactNotifications($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\ContactNotifications($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charContractBids($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\ContractBids($this->app);

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
    public function charContractItems($apiKey, $vCode, $characterID, $contractID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\ContractItems($this->app);

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
    public function charContracts($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $contractID = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\Contracts($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $contractID = null);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charFacWarStats($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\FacWarStats($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charIndustryJobs($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\IndustryJobs($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charIndustryJobsHistory($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\IndustryJobsHistory($this->app);

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
    public function charKillMails($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $fromID = null,
        /** @noinspection PhpUnusedParameterInspection */
        $rowCount = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\KillMails($this->app);

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
    public function charLocations($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $ids = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\Locations($this->app);

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
    public function charMailBodies($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $ids = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\MailBodies($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $ids = array());
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charMailMessages($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\MailMessages($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charMailingLists($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\MailingLists($this->app);

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
    public function charMarketOrders($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $orderID = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\MarketOrders($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $orderID = null);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charMedals($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\Medals($this->app);

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
    public function charNotificationTexts($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $ids = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\NotificationTexts($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $ids = array());
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charNotifications($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\Notifications($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charPlanetaryColonies($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\PlanetaryColonies($this->app);

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
    public function charPlanetaryLinks($apiKey, $vCode, $characterID, $planetID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\PlanetaryLinks($this->app);

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
    public function charPlanetaryPins($apiKey, $vCode, $characterID, $planetID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\PlanetaryPins($this->app);

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
    public function charPlanetaryRoutes($apiKey, $vCode, $characterID, $planetID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\PlanetaryRoutes($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $planetID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charResearch($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\Research($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charSkillInTraining($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\SkillInTraining($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charSkillQueue($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\SkillQueue($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charStandings($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\Standings($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function charUpcomingCalendarEvents($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\UpcomingCalendarEvents($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param int  $accountKey
     * @param null $fromID
     * @param null $rowCount
     *
     * @return mixed
     */
    public function charWalletJournal($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $accountKey = 1000,
        /** @noinspection PhpUnusedParameterInspection */
        $fromID = null,
        /** @noinspection PhpUnusedParameterInspection */
        $rowCount = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\WalletJournal($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param int  $accountKey
     * @param null $fromID
     * @param null $rowCount
     *
     * @return mixed
     */
    public function charWalletTransactions($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $accountKey = 1000,
        /** @noinspection PhpUnusedParameterInspection */
        $fromID = null,
        /** @noinspection PhpUnusedParameterInspection */
        $rowCount = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Character\WalletTransactions($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpAccountBalance($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\AccountBalance($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpAssetList($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\AssetList($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpBlueprints($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\Blueprints($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpContactList($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\ContactList($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpContainerLog($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\ContainerLog($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpContractBids($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\ContractBids($this->app);

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
    public function corpContractItems($apiKey, $vCode, $characterID, $contractID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\ContractItems($this->app);

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
    public function corpContracts($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $contractID = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\Contracts($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $contractID = null);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param null $corporationID
     *
     * @return mixed
     */
    public function corpCorporationSheet($apiKey, $vCode,
        /** @noinspection PhpUnusedParameterInspection */
        $corporationID = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\CorporationSheet($this->app);

        return $return->getData($apiKey, $vCode, $corporationID = null);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpCustomsOffices($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\CustomsOffices($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpFacWarStats($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\FacWarStats($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     *
     * @return mixed
     */
    public function corpFacilities($apiKey, $vCode)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\Facilities($this->app);

        return $return->getData($apiKey, $vCode);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpIndustryJobs($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\IndustryJobs($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpIndustryJobsHistory($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\IndustryJobsHistory($this->app);

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
    public function corpKillMails($apiKey, $vCode,
        /** @noinspection PhpUnusedParameterInspection */
        $fromID = null,
        /** @noinspection PhpUnusedParameterInspection */
        $rowCount = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\KillMails($this->app);

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
    public function corpLocations($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $ids = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\Locations($this->app);

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
    public function corpMarketOrders($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $orderID = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\MarketOrders($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $orderID = null);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpMedals($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\Medals($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpMemberMedals($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\MemberMedals($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpMemberSecurity($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\MemberSecurity($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpMemberSecurityLog($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\MemberSecurityLog($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param int $extended
     *
     * @return mixed
     */
    public function corpMemberTracking($apiKey, $vCode,
        /** @noinspection PhpUnusedParameterInspection */
        $extended = 0)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\MemberTracking($this->app);

        return $return->getData($apiKey, $vCode, $extended = 0);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpOutpostList($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\OutpostList($this->app);

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
    public function corpOutpostServiceDetail($apiKey, $vCode, $characterID, $itemID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\OutpostServiceDetail($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $itemID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpShareholders($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\Shareholders($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpStandings($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\Standings($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $itemID
     *
     * @return mixed
     */
    public function corpStarbaseDetail($apiKey, $vCode, $itemID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\StarbaseDetail($this->app);

        return $return->getData($apiKey, $vCode, $itemID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     *
     * @return mixed
     */
    public function corpStarbaseList($apiKey, $vCode)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\StarbaseList($this->app);

        return $return->getData($apiKey, $vCode);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function corpTitles($apiKey, $vCode, $characterID)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\Titles($this->app);

        return $return->getData($apiKey, $vCode, $characterID);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param int  $accountKey
     * @param null $fromID
     * @param null $rowCount
     *
     * @return mixed
     */
    public function corpWalletJournal($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $accountKey = 1000,
        /** @noinspection PhpUnusedParameterInspection */
        $fromID = null,
        /** @noinspection PhpUnusedParameterInspection */
        $rowCount = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\WalletJournal($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null);
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param int  $accountKey
     * @param null $fromID
     * @param null $rowCount
     *
     * @return mixed
     */
    public function corpWalletTransactions($apiKey, $vCode, $characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $accountKey = 1000,
        /** @noinspection PhpUnusedParameterInspection */
        $fromID = null,
        /** @noinspection PhpUnusedParameterInspection */
        $rowCount = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Corporation\WalletTransactions($this->app);

        return $return->getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null);
    }

    /**
     * @return mixed
     */
    public function eveAllianceList()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\AllianceList($this->app);

        return $return->getData();
    }

    /**
     * @param array $characterIDs
     *
     * @return mixed
     */
    public function eveCharacterAffiliation(
        /** @noinspection PhpUnusedParameterInspection */
        $characterIDs = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\CharacterAffiliation($this->app);

        return $return->getData($characterIDs = array());
    }

    /**
     * @param array $characterNames
     *
     * @return mixed
     */
    public function eveCharacterID(
        /** @noinspection PhpUnusedParameterInspection */
        $characterNames = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\CharacterID($this->app);

        return $return->getData($characterNames = array());
    }

    /**
     * @param $characterID
     * @param null $apiKey
     * @param null $vCode
     *
     * @return mixed
     */
    public function eveCharacterInfo($characterID,
        /** @noinspection PhpUnusedParameterInspection */
        $apiKey = null,
        /** @noinspection PhpUnusedParameterInspection */
        $vCode = null)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\CharacterInfo($this->app);

        return $return->getData($characterID, $apiKey = null, $vCode = null);
    }

    /**
     * @param array $characterIDs
     *
     * @return mixed
     */
    public function eveCharacterName(
        /** @noinspection PhpUnusedParameterInspection */
        $characterIDs = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\CharacterName($this->app);

        return $return->getData($characterIDs = array());
    }

    /**
     * @return mixed
     */
    public function eveConquerableStationList()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\ConquerableStationList($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function eveErrorList()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\ErrorList($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function eveFacWarStats()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\FacWarStats($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function eveFacWarTopStats()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\FacWarTopStats($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function eveRefTypes()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\RefTypes($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function eveSkillTree()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\SkillTree($this->app);

        return $return->getData();
    }

    /**
     * @param array $typeIDs
     *
     * @return mixed
     */
    public function eveTypeName(
        /** @noinspection PhpUnusedParameterInspection */
        $typeIDs = array())
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\EVE\TypeName($this->app);

        return $return->getData($typeIDs = array());
    }

    /**
     * @return mixed
     */
    public function mapFacWarSystems()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Map\FacWarSystems($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function mapJumps()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Map\Jumps($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function mapKills()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Map\Kills($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function mapSovereignty()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Map\Sovereignty($this->app);

        return $return->getData();
    }

    /**
     * @return mixed
     */
    public function serverServerStatus()
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $return = new \ProjectRena\Model\EVEApi\Server\ServerStatus($this->app);

        return $return->getData();
    }
};
