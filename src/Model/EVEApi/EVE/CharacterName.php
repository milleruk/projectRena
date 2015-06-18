<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\RenaApp;

/**
 * Class CharacterName.
 */
class CharacterName
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
     * @param array $characterIDs Max 250 characterIDs
     *
     * @return mixed
     */
    public function getData($characterIDs = array())
    {
        $pheal = $this->app->Pheal->Pheal();
        $pheal->scope = 'EVE';
        $result = $pheal->CharacterName(array('ids' => implode(',', $characterIDs)))->toArray();

        return $result;
    }
}
