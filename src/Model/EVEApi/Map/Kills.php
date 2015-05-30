<?php

namespace ProjectRena\Model\EVEApi\Map;



/**
 * Class Kills.
 */
class Kills
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
        $result = $pheal->Kills()->toArray();

        return $result;
    }
}
