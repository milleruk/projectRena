<?php

namespace ProjectRena\Controller;

use ProjectRena\RenaApp;

/**
 * Class LoginController
 *
 * @package ProjectRena\Controller
 */
class LoginController
{
				protected $app;

				function __construct(RenaApp $app)
				{
								$this->app = $app;
				}

				public function loginEVE()
				{
								$code = $this->app->request->get("code");
								$state = $this->app->request->get("state");

								$this->app->EVEOAuth->SSOLogin($code, $state);
				}
}
