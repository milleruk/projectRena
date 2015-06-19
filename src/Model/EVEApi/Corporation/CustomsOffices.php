<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\RenaApp;

/**
 * Class CustomsOffices.
 */
class CustomsOffices
{
				/**
				 * @var int
				 */
				public $accessMask = 2;

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
				 * @param $characterID
				 *
				 * @return mixed
				 */
				public function getData($apiKey, $vCode, $characterID)
				{
								$pheal = $this->app->Pheal($apiKey, $vCode);
								$pheal->scope = 'Corp';
								$result = $pheal->CustomsOffices(array('characterID' => $characterID))->toArray();

								return $result;
				}
}
