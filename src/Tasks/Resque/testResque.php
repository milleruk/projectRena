<?php

namespace ProjectRena\Tasks\Resque;


/**
 * Class testResque
 * @package ProjectRena\Tasks\Resque
 */
class testResque {
    /**
     *
     */
    public function setUp()
    {

    }

    /**
     *
     */
    public function perform()
    {
        echo $this->args["name"];
    }

    /**
     *
     */
    public function tearDown()
    {

    }
}