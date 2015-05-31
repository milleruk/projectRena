<?php

namespace ProjectRena\Model\EVEApi\Character;



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
    function __construct($app)
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
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $result = $pheal->AccountBalance(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
