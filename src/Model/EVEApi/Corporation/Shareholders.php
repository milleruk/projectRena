<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class Shareholders.
 */
class Shareholders
{
    /**
     * @var int
     */
    public $accessMask = 65536;

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
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->Shareholders(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
