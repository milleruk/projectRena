<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class StarbaseList.
 */
class StarbaseList
{
    /**
     * @var int
     */
    public $accessMask = 524288;

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
     * @param $apiKey
     * @param $vCode
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->StarbaseList()->toArray();

        return $result;
    }
}
