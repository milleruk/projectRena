<?php

namespace ProjectRena\Model\EVEApi\EVE;

use ProjectRena\RenaApp;

/**
 * Class ErrorList.
 */
class ErrorList
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
								$pheal = $this->app->Pheal->Pheal();
								$pheal->scope = 'EVE';
								$result = $pheal->ErrorList()->toArray();

								return $result;
				}
}
