<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class Locations.
 */
class Locations
{
    /**
     * @var int
     */
    public $accessMask = 16777216;

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
        $pheal->scope = 'Corp';
        $result = $pheal->Locations(array('characterID' => $characterID, 'IDs' => implode(',', $ids)))->toArray();

        return $result;
    }
}
