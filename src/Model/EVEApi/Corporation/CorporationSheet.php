<?php

namespace ProjectRena\Model\EVEApi\Corporation;

use ProjectRena\RenaApp;

/**
 * Class CorporationSheet.
 */
class CorporationSheet
{
				/**
				 * @var int
				 */
				public $accessMask = 8;

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
				 * @param null $corporationID
				 *
				 * @return mixed
				 */
				public function getData($apiKey, $vCode, $corporationID = null)
				{
								$pheal = $this->app->Pheal($apiKey, $vCode);
								$pheal->scope = 'Corp';
								$requestArray = array();
								if(isset($corporationID))
								{
												$requestArray['corporationID'] = $corporationID;
								}
								$result = $pheal->CorporationSheet($requestArray)->toArray();

								return $result;
				}
}
