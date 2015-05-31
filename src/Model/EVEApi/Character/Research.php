<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class Research.
 */
class Research
{
    /**
     * @var int
     */
    public $accessMask = 65536;

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
        $result = $pheal->Research(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
