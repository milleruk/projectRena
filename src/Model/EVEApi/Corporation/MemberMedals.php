<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class MemberMedals.
 */
class MemberMedals
{
    /**
     * @var int
     */
    public $accessMask = 4;

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
        $result = $pheal->MemberMedals(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
