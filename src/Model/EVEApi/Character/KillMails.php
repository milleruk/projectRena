<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class KillMails.
 */
class KillMails
{
    /**
     * @var int
     */
    public $accessMask = 256;

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
     * @param null $fromID
     * @param null $rowCount
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $fromID = null, $rowCount = null)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Char';

        $requestArray = array('characterID' => $characterID);
        if (isset($fromID)) {
            $requestArray['fromID'] = $fromID;
        }
        if (isset($rowCount)) {
            $requestArray['rowCount'] = $rowCount;
        }
        $result = $pheal->KillMails($requestArray)->toArray();

        return $result;
    }
}
