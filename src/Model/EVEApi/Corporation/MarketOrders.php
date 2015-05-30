<?php

namespace ProjectRena\Model\EVEApi\Corporation;



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
     * @param null $orderID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $orderID = null)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $requestArray = array('characterID' => $characterID);
        if (isset($orderID)) {
            $requestArray['orderID'] = $orderID;
        }
        $result = $pheal->MarketOrders($requestArray)->toArray();

        return $result;
    }
}
