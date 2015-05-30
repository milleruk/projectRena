<?php

namespace ProjectRena\Model\EVEApi\Map;



/**
 * Class FacWarSystems.
 */
class FacWarSystems
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
        $pheal->scope = 'Map';
        $result = $pheal->FacWarSystems()->toArray();

        return $result;
    }
}
