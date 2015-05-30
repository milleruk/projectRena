<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\Lib\PhealLoader;

/**
 * Class ContractBids.
 */
class ContractBids
{
    /**
     * @var int
     */
    public $accessMask = 67108864;

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
        $pheal->scope = 'Char';
        $result = $pheal->ContractBids(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
