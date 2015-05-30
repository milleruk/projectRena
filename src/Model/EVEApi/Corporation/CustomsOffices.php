<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class CustomsOffices.
 */
class CustomsOffices
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
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->CustomsOffices(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
