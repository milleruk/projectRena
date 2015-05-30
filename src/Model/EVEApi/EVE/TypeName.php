<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class TypeName.
 */
class TypeName
{
    /**
     * @var int
     */
    public $accessMask = null;

    /**
     * @param array $typeIDs Max 250 IDs at a time
     *
     * @return mixed
     */
    public function getData($typeIDs = array())
    {
        $pheal = PhealLoader::loadPheal();
        $pheal->scope = 'EVE';
        $result = $pheal->TypeName(array('ids' => implode(',', $typeIDs)))->toArray();

        return $result;
    }
}
