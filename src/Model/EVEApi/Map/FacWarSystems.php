<?php

namespace ProjectRena\Model\EVEApi\Map;

use ProjectRena\RenaApp;

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
        $pheal = $this->app->Pheal;
        $pheal->scope = 'Map';
        $result = $pheal->FacWarSystems()->toArray();

        return $result;
    }
}
