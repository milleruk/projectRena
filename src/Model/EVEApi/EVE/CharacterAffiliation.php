<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class CharacterAffiliation.
 */
class CharacterAffiliation
{
    /**
     * @var int
     */
    public $accessMask = null;

    /**
     * @return mixed
     */
    public function getData($characterIDs = array())
    {
        $pheal = PhealLoader::loadPheal();
        $pheal->scope = 'EVE';
        $result = $pheal->CharacterAffiliation(array('ids' => implode(',', $characterIDs)))->toArray();

        return $result;
    }
}
