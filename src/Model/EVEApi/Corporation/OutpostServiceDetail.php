<?php

namespace ProjectRena\Model\EVEApi\Corporation;



/**
 * Class OutpostServiceDetail.
 */
class OutpostServiceDetail
{
    /**
     * @var int
     */
    public $accessMask = 32768;

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
     * @param $characterID
     * @param $itemID
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $itemID)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Corp';
        $result = $pheal->OutpostServiceDetail(array('characterID' => $characterID, 'itemID' => $itemID))->toArray();

        return $result;
    }
}
