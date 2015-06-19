<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\RenaApp;

/**
 * Class PlanetaryPins.
 */
class PlanetaryPins
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
				 * @param $planetID
				 *
				 * @return mixed
				 */
				public function getData($apiKey, $vCode, $characterID, $planetID)
				{
								$pheal = $this->app->Pheal($apiKey, $vCode);
								$pheal->scope = 'Char';
								$result = $pheal->PlanetaryPins(array('characterID' => $characterID, 'planetID' => $planetID))->toArray();

								return $result;
				}
}
