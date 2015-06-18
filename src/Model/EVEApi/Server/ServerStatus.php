<?php

namespace ProjectRena\Model\EVEApi\Server;

use ProjectRena\RenaApp;

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
    function __construct(RenaApp $app)
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $pheal = $this->app->Pheal;
        $pheal->scope = 'Server';
        $result = $pheal->ServerStatus()->toArray();

        return $result;
    }
}
