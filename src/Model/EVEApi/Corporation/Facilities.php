<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class Facilities.
 */
class Facilities
{
    /**
     * @var int
     */
    public $accessMask = 128;

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
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->Facilities()->toArray();

        return $result;
    }
}
