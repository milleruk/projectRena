<?php

namespace ProjectRena\Model\EVEApi\EVE;



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
    function __construct($app)
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
        $pheal = $this->app->pheal;
        $pheal->scope = 'EVE';
        $result = $pheal->CharacterName(array('ids' => implode(',', $characterIDs)))->toArray();

        return $result;
    }
}
