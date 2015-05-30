<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\Lib\PhealLoader;

/**
 * Class StarbaseDetail.
 */
class StarbaseDetail
{
    /**
     * @var int
     */
    public $accessMask = 131072;

    /**
     * @param $apiKey
     * @param $vCode
     * @param $itemID
     *
     * @return mixed
     *
     * @internal param $characterID
     */
    public function getData($apiKey, $vCode, $itemID)
    {
        $pheal = PhealLoader::loadPheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->StarbaseDetail(array('itemID' => $itemID))->toArray();

        return $result;
    }
}
