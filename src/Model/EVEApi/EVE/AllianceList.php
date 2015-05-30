<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class AllianceList.
 */
class AllianceList
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
        $result = $pheal->AllianceList()->toArray();

        return $result;
    }
}
