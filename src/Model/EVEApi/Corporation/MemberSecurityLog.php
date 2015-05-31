<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class MemberSecurityLog.
 */
class MemberSecurityLog
{
    /**
     * @var int
     */
    public $accessMask = 1024;

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
        $pheal->scope = 'Corp';
        $result = $pheal->MemberSecurityLog(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
