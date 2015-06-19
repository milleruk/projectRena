<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\RenaApp;

/**
 * Class MemberSecurityLog.
 */
class MemberSecurityLog
{
				/**
				 * @var int
				 */
				public $accessMask = 1024;

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
								$result = $pheal->MemberSecurityLog(array('characterID' => $characterID))->toArray();

								return $result;
				}
}
