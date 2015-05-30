<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\Lib\PhealLoader;

/**
 * Class PlanetaryRoutes.
 */
class PlanetaryRoutes
{
    /**
     * @var int
     */
    public $accessMask = 2;

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param $planetID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $planetID)
    {
        $pheal = PhealLoader::loadPheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $result = $pheal->PlanetaryRoutes(array('characterID' => $characterID, 'planetID' => $planetID))->toArray();

        return $result;
    }
}
