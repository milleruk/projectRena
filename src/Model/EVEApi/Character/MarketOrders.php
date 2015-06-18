<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\RenaApp;

/**
 * Class MarketOrders.
 */
class MarketOrders
{
    /**
     * @var int
     */
    public $accessMask = 4096;

    /**
     * @var
     */
    private $app;

    /**
     * @param \ProjectRena\RenaApp $app
     */
    function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param null $orderID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $orderID = null)
    {
        $pheal = $this->app->Pheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $requestArray = array('characterID' => $characterID);
        if (isset($orderID)) {
            $requestArray['orderID'] = $orderID;
        }
        $result = $pheal->MarketOrders($requestArray)->toArray();

        return $result;
    }
}
