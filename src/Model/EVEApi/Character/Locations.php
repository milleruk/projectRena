<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\RenaApp;

/**
 * Class Locations.
 */
class Locations
{
				/**
				 * @var int
				 */
				public $accessMask = 134217728;

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
				 * @param array $ids
				 *
				 * @return mixed
				 */
				public function getData($apiKey, $vCode, $characterID, $ids = array())
				{
								$pheal = $this->app->Pheal($apiKey, $vCode);
								$pheal->scope = 'Char';
								$result = $pheal->Locations(array('characterID' => $characterID, 'IDs' => implode(',', $ids)))->toArray();

								return $result;
				}
}
