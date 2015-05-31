<?php

namespace ProjectRena\Model\EVEApi\EVE;



/**
 * Class AllianceList.
 */
class AllianceList
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
    public function getData()
    {
        $pheal = $this->app->pheal;
        $pheal->scope = 'EVE';
        $result = $pheal->AllianceList()->toArray();

        return $result;
    }
}
