<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\Lib\PhealLoader;

/**
 * Class ErrorList.
 */
class ErrorList
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
        $result = $pheal->ErrorList()->toArray();

        return $result;
    }
}
