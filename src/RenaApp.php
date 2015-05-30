<?php
namespace ProjectRena;

use ProjectRena\Lib\Service\baseConfig;
use ProjectRena\Lib\Service\Logging;
use ProjectRena\Lib\Service\Cache;
use ProjectRena\Lib\Service\cURL;
use ProjectRena\Lib\Service\Database;
use ProjectRena\Lib\Service\StatsD;
use ProjectRena\Lib\SessionHandler;
use ProjectRena\Lib\Timer;
use ProjectRena\Model\ApiKeys;
use ProjectRena\Model\Config;
use ProjectRena\Model\EVEApi;
use ProjectRena\Model\OAuth\EVE;
use Slim\Slim;

/**
 * @property Logging logger
 * @property Config userConfig
 * @property baseConfig baseConfig
 * @property Cache cache
 * @property cURL curl
 * @property Database db
 * @property Timer timer;
 * @property EVEApi eveapi;
 * @property ApiKeys apikeys;
 * @property StatsD statsd;
 * @property SessionHandler sessionHandler;
 * @property EVE eveoauth
 */
class RenaApp extends Slim
{

}