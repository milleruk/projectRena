<?php

namespace ProjectRena\Model\EVEApi\EVE;



/**
 * Class TypeName.
 */
class TypeName
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
     * @param array $typeIDs Max 250 IDs at a time
     *
     * @return mixed
     */
    public function getData($typeIDs = array())
    {
        $pheal = $this->app->pheal;
        $pheal->scope = 'EVE';
        $result = $pheal->TypeName(array('ids' => implode(',', $typeIDs)))->toArray();

        return $result;
    }
}
