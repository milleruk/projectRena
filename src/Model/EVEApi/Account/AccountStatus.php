<?php

namespace ProjectRena\Model\EVEApi\Account;



/**
 * Class AccountStatus.
 */
class AccountStatus
{
    /**
     * @var int
     */
    public $accessMask = 33554432;

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
        $result = $pheal->accountStatus()->toArray();

        return $result;
    }
}
