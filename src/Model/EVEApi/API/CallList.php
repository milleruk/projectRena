<?php

namespace ProjectRena\Model\EVEApi\API;



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
        $pheal->scope = 'API';
        $result = $pheal->CallList()->toArray();

        return $result;
    }
}
