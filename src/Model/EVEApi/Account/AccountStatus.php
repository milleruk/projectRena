<?php

namespace ProjectRena\Model\EVEApi\Account;

use ProjectRena\Lib\PhealLoader;

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
     * @param $apiKey
     * @param $vCode
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode)
    {
        $pheal = PhealLoader::loadPheal($apiKey, $vCode);
        $pheal->scope = 'Account';
        $result = $pheal->accountStatus()->toArray();

        return $result;
    }
}
