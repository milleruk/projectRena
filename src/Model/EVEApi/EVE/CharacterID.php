<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\RenaApp;

/**
 * Class CharacterID.
 */
class CharacterID
{
    /**
     * @var int
     */
    public $accessMask = null;

    /**
     * @var
     */
    private $app;

    /**
     * @param \ProjectRena\RenaApp $app
     */
    function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    /**
     * @param array $characterNames
     *
     * @return mixed
     */
    public function getData($characterNames = array())
    {
        $pheal = $this->app->Pheal;
        $pheal->scope = 'EVE';
        $result = $pheal->CharacterID(array('names' => implode(',', $characterNames)))->toArray();

        return $result;
    }
}
