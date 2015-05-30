<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\Lib\PhealLoader;

/**
 * Class MailBodies.
 */
class MailBodies
{
    /**
     * @var int
     */
    public $accessMask = 512;

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
        $pheal->scope = 'Char';
        $result = $pheal->MailBodies(array('characterID' => $characterID, 'ids' => implode(',', $ids)))->toArray();

        return $result;
    }
}
