<?php

namespace ProjectRena\Model\EVEApi\Map;



/**
 * Class Sovereignty.
 */
class Sovereignty
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
     * @param \ProjectRena\RenaApp $app
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
        $result = $pheal->Sovereignty()->toArray();

        return $result;
    }
}
