<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\RenaApp;

/**
 * Class StarbaseList.
 */
class StarbaseList
{
				/**
				 * @var int
				 */
				public $accessMask = 524288;

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
				 * @param $apiKey
				 * @param $vCode
				 *
				 * @return mixed
				 */
				public function getData($apiKey, $vCode)
				{
								$pheal = $this->app->Pheal($apiKey, $vCode);
								$pheal->scope = 'Corp';
								$result = $pheal->StarbaseList()->toArray();

								return $result;
				}
}
