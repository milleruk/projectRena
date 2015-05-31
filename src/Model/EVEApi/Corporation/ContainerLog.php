<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class ContainerLog.
 */
class ContainerLog
{
    /**
     * @var int
     */
    public $accessMask = 32;

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
        $result = $pheal->ContainerLog(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
