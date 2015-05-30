<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class Locations.
 */
class Locations
{
    /**
     * @var int
     */
    public $accessMask = 134217728;

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
     * @param array $ids
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $ids = array())
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $result = $pheal->Locations(array('characterID' => $characterID, 'IDs' => implode(',', $ids)))->toArray();

        return $result;
    }
}
