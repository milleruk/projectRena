<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class SkillQueue.
 */
class SkillQueue
{
    /**
     * @var int
     */
    public $accessMask = 262144;

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
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID)
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $result = $pheal->SkillQueue(array('characterID' => $characterID))->toArray();

        return $result;
    }
}
