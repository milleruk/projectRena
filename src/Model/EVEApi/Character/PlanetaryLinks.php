<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\RenaApp;

/**
 * Class PlanetaryLinks.
 */
class PlanetaryLinks
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
								$result = $pheal->PlanetaryLinks(array('characterID' => $characterID, 'planetID' => $planetID))->toArray();

								return $result;
				}
}
