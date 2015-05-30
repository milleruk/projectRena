<?php

namespace ProjectRena\Model\EVEApi\Map;



/**
 * Class Jumps.
 */
class Jumps
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
        $result = $pheal->Jumps()->toArray();

        return $result;
    }
}
