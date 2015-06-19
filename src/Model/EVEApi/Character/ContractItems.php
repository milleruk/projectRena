<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\RenaApp;

/**
 * Class ContractItems.
 */
class ContractItems
{
				/**
				 * @var int
				 */
				public $accessMask = 67108864;

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
				 * @param $contractID
				 *
				 * @return mixed
				 */
				public function getData($apiKey, $vCode, $characterID, $contractID)
				{
								$pheal = $this->app->Pheal($apiKey, $vCode);
								$pheal->scope = 'Char';
								$result = $pheal->ContractItems(array('characterID' => $characterID, 'contractID' => $contractID))->toArray();

								return $result;
				}
}
