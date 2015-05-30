<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class Locations.
 */
class Locations
{
    /**
     * @var int
     */
    public $accessMask = 16777216;

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param array $ids
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $ids = array())
    {
        $pheal = PhealLoader::loadPheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->Locations(array('characterID' => $characterID, 'IDs' => implode(',', $ids)))->toArray();

        return $result;
    }
}
