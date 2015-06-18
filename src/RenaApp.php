<?php

namespace ProjectRena;

use ProjectRena\Lib\baseConfig;
use ProjectRena\Lib\Logging;
use ProjectRena\Lib\Cache;
use ProjectRena\Lib\cURL;
use ProjectRena\Lib\Db;
use ProjectRena\Lib\StatsD;
use ProjectRena\Lib\Timer;
use ProjectRena\Model\ApiKeys;
use ProjectRena\Model\Config;
use ProjectRena\Model\EVEApi;
use ProjectRena\Model\Paste;
use ProjectRena\Model\Users;
use Slim\Slim;

/**
 * @property Logging Logging
 * @property Config Config
 * @property baseConfig baseConfig
 * @property Cache Cache
 * @property cURL cURL
 * @property Db Db
 * @property Timer Timer;
 * @property EVEApi EVEApi;
 * @property ApiKeys ApiKeys;
 * @property StatsD StatsD;
 * @property Users Users
 * @property Paste Paste
 */
class RenaApp extends Slim
{
}