<?php

namespace ProjectRena\Model\EVEApi\EVE;



/**
 * Class ConquerableStationList.
 */
class ConquerableStationList
{
    /**
     * @var int
     */
    public $accessMask = null;

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
     * @return mixed
     */
    public function getData()
    {
        $pheal = $this->app->pheal;
        $pheal->scope = 'EVE';
        $result = $pheal->ConquerableStationList()->toArray();

        return $result;
    }
}
