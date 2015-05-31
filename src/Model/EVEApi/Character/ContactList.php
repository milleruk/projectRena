<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class ContactList.
 */
class ContactList
{
    /**
     * @var int
     */
    public $accessMask = 16;

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
        $result = $pheal->ContactList(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
