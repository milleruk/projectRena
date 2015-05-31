<?php

namespace ProjectRena\Model\EVEApi\Server;



/**
 * Class ServerStatus.
 */
class ServerStatus
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
        $pheal->scope = 'Server';
        $result = $pheal->ServerStatus()->toArray();

        return $result;
    }
}
