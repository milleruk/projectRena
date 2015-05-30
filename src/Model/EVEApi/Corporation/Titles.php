<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class Titles.
 */
class Titles
{
    /**
     * @var int
     */
    public $accessMask = 4194304;

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
        $result = $pheal->Titles(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
