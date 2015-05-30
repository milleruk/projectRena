<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class SkillTree.
 */
class SkillTree
{
    /**
     * @var int
     */
    public $accessMask = null;

    /**
     * @return mixed
     */
    public function getData()
    {
        $pheal = PhealLoader::loadPheal();
        $pheal->scope = 'EVE';
        $result = $pheal->SkillTree()->toArray();

        return $result;
    }
}
