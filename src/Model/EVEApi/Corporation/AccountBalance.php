<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\RenaApp;

/**
 * Class AccountBalance.
 */
class AccountBalance
{
    /**
     * @var int
     */
    public $accessMask = 1;

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
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID)
    {
        $pheal = $this->app->Pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->AccountBalance(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
