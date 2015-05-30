<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class CharacterID.
 */
class CharacterID
{
    /**
     * @var int
     */
    public $accessMask = null;

    /**
     * @param array $characterNames
     *
     * @return mixed
     */
    public function getData($characterNames = array())
    {
        $pheal = PhealLoader::loadPheal();
        $pheal->scope = 'EVE';
        $result = $pheal->CharacterID(array('names' => implode(',', $characterNames)))->toArray();

        return $result;
    }
}
