<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class FacWarStats.
 */
class FacWarStats
{
    /**
     * @var int
     */
    public $accessMask = 64;

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
        $result = $pheal->FacWarStats(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
