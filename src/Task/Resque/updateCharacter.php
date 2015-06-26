<?php

namespace ProjectRena\Task\Resque;

/**
 * Class testResque.
 */
class testResque
{
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
								echo $this->args['name'];
				}

				/**
				 *
				 */
				public function tearDown()
				{
				}
}
