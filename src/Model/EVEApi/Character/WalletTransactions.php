<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class WalletTransactions.
 */
class WalletTransactions
{
    /**
     * @var int
     */
    public $accessMask = 4194304;

    /**
     * @var
     */
    private $app;

    /**
     * @param $app
     */
    function __construct($app)
    {
        $this->app = $app;
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
    public function getData($apiKey, $vCode, $characterID, $accountKey = 1000, $fromID = null, $rowCount = null)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $requestArray = array('characterID' => $characterID, 'accountKey' => $accountKey);
        if (isset($fromID)) {
            $requestArray['fromID'] = $fromID;
        }
        if (isset($rowCount)) {
            $requestArray['rowCount'] = $rowCount;
        }

        $result = $pheal->WalletTransactions($requestArray)->toArray();

        return $result;
    }
}
