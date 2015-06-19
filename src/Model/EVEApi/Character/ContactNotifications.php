<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\RenaApp;

/**
 * Class ContactNotifications.
 */
class ContactNotifications
{
				/**
				 * @var int
				 */
				public $accessMask = 32;

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
								$pheal->scope = 'Char';
								$result = $pheal->ContactNotifications(array('characterID' => $characterID))->toArray();

								return $result;
				}
}
