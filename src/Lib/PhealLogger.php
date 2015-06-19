<?php
namespace ProjectRena\Lib;

class PhealLogger implements \Pheal\Log\CanLog
{
				private $logID = null;

				public function start()
				{
				}

				public function stop()
				{
				}

				public function log($scope, $name, $opts)
				{
								// Insert stuff into the DB for logging purposes
				}

				public function errorLog($scope, $name, $opts, $message)
				{
								// Implement error logging, especially 904 logging
				}
}