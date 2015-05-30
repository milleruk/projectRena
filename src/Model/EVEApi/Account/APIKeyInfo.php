<?php

namespace ProjectRena\Model\EVEApi\Account;



/**
 * Class APIKeyInfo.
 */
class APIKeyInfo
{
    /**
     * @var null
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
     * @param $apiKey
     * @param $vCode
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Account';
        $result = $pheal->APIKeyInfo()->toArray();

        return $result;
    }
}
