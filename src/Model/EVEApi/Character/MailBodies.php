<?php

namespace ProjectRena\Model\EVEApi\Character;



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
     * @param array $ids
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $ids = array())
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $result = $pheal->MailBodies(array('characterID' => $characterID, 'ids' => implode(',', $ids)))->toArray();

        return $result;
    }
}
