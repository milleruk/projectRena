<?php

namespace ProjectRena\Model\EVEApi\Map;

use ProjectRena\RenaApp;

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
     * @param \ProjectRena\RenaApp $app
     */
    function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $pheal = $this->app->Pheal->Pheal();
        $pheal->scope = 'Map';
        $result = $pheal->Kills()->toArray();

        return $result;
    }
}
