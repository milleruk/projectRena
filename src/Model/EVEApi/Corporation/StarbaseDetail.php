<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class StarbaseDetail.
 */
/**
 * Class StarbaseDetail
 *
 * @package ProjectRena\Model\EVEApi\Corporation
 */
class StarbaseDetail
{
    /**
     * @var int
     */
    public $accessMask = 131072;

    /**
     * @var
     */
    private $app;

    /**
     * @param $app
     */
    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param $apiKey
     * @param $vCode
     * @param $itemID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $itemID)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->StarbaseDetail(array('itemID' => $itemID))->toArray();

        return $result;
    }
}
