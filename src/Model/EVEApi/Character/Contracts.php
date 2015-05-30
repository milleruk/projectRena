<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class Contracts.
 */
class Contracts
{
    /**
     * @var int
     */
    public $accessMask = 67108864;

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
        $pheal->scope = 'Char';
        $requestArray = array('characterID' => $characterID);
        if (isset($contractID)) {
            $requestArray['contractID'] = $contractID;
        }
        $result = $pheal->Contracts($requestArray)->toArray();

        return $result;
    }
}
