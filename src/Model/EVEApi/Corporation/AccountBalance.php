<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class AccountBalance.
 */
class AccountBalance
{
    /**
     * @var int
     */
    public $accessMask = 1;

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID)
    {
        $pheal = PhealLoader::loadPheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->AccountBalance(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
