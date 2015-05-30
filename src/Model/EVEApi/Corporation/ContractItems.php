<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class ContractItems.
 */
class ContractItems
{
    /**
     * @var int
     */
    public $accessMask = 8388608;

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param $contractID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $contractID)
    {
        $pheal = PhealLoader::loadPheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->ContractItems(array('characterID' => $characterID, 'contractID' => $contractID))->toArray();

        return $result;
    }
}
