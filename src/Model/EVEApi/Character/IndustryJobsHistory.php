<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\Lib\PhealLoader;

/**
 * Class IndustryJobsHistory.
 */
class IndustryJobsHistory
{
    /**
     * @var int
     */
    public $accessMask = 128;

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
        $result = $pheal->IndustryJobsHistory(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
