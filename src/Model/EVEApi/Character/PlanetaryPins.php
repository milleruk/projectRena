<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class PlanetaryPins.
 */
class PlanetaryPins
{
    /**
     * @var int
     */
    public $accessMask = 2;

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
     * @param $planetID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $planetID)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $result = $pheal->PlanetaryPins(array('characterID' => $characterID, 'planetID' => $planetID))->toArray();

        return $result;
    }
}
