<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\Lib\PhealLoader;

/**
 * Class SkillQueue.
 */
class SkillQueue
{
    /**
     * @var int
     */
    public $accessMask = 262144;

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
        $result = $pheal->SkillQueue(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
