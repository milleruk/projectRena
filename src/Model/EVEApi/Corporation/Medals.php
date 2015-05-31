<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class Medals.
 */
class Medals
{
    /**
     * @var int
     */
    public $accessMask = 8192;

    /**
     * @var
     */
    private $app;

    /**
     * @param \ProjectRena\RenaApp $app
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
        $result = $pheal->Medals(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
