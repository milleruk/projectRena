<?php

namespace ProjectRena\Model\EVEApi\EVE;



/**
 * Class CharacterAffiliation.
 */
class CharacterAffiliation
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
    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public function getData($characterIDs = array())
    {
        $pheal = $this->app->pheal;
        $pheal->scope = 'EVE';
        $result = $pheal->CharacterAffiliation(array('ids' => implode(',', $characterIDs)))->toArray();

        return $result;
    }
}
