<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\Lib\PhealLoader;

/**
 * Class PlanetaryPins.
 */
class PlanetaryPins
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
        $result = $pheal->PlanetaryPins(array('characterID' => $characterID, 'planetID' => $planetID))->toArray();

        return $result;
    }
}
