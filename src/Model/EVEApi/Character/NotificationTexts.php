<?php

namespace ProjectRena\Model\EVEApi\Character;



/**
 * Class NotificationTexts.
 */
class NotificationTexts
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
     * @param array $ids
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $ids = array())
    {
        $pheal = $this->app->pheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $result = $pheal->NotificationTexts(array('characterID' => $characterID, 'IDs' => implode(',', $ids)))->toArray();

        return $result;
    }
}
