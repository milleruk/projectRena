<?php

namespace ProjectRena\Model\EVEApi\Map;

use ProjectRena\Lib\PhealLoader;

/**
 * Class Jumps.
 */
class Jumps
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
        $pheal->scope = 'Map';
        $result = $pheal->Jumps()->toArray();

        return $result;
    }
}
