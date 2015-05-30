<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class IndustryJobs.
 */
class IndustryJobs
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
        $pheal->scope = 'Corp';
        $result = $pheal->IndustryJobs(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
