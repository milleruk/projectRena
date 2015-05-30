<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class Standings.
 */
class Standings
{
    /**
     * @var int
     */
    public $accessMask = 262144;

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
        $result = $pheal->Standings(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
