<?php

namespace ProjectRena\Model\EVEApi\API;

use ProjectRena\RenaApp;

/**
 * Class CallList.
 */
class CallList
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
        $pheal->scope = 'API';
        $result = $pheal->CallList()->toArray();

        return $result;
    }
}
