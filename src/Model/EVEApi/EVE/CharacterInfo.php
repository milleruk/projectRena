<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\RenaApp;

/**
 * Class CharacterInfo.
 */
class CharacterInfo
{
    /**
     * @var int
     */
    public $accessMask = null;

    /**
     * @var
     */
    private $app;

    /**
     * @param \ProjectRena\RenaApp $app
     */
    function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    /**
     * @param $characterID
     * @param null $apiKey
     * @param null $vCode
     *
     * @return mixed
     */
    public function getData($characterID, $apiKey = null, $vCode = null)
    {
        $pheal = $this->app->Pheal;
        $pheal->scope = 'EVE';
        $requestArray = array('characterID' => $characterID);

        if (isset($apiKey)) {
            $requestArray['apiKey'] = $apiKey;
        }
        if (isset($vCode)) {
            $requestArray['vCode'] = $vCode;
        }
        $result = $pheal->CharacterInfo($requestArray)->toArray();

        return $result;
    }
}
