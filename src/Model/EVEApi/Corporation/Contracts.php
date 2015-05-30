<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class Contracts.
 */
class Contracts
{
    /**
     * @var int
     */
    public $accessMask = 8388608;

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
     * @param null $contractID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $contractID = null)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $requestArray = array('characterID' => $characterID);
        if (isset($contractID)) {
            $requestArray['contractID'] = $contractID;
        }
        $result = $pheal->Contracts($requestArray)->toArray();

        return $result;
    }
}
