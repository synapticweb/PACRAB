<?php

//load configuration
require_once 'config.php';

// setup the autoloading
require_once 'vendor/autoload.php';

// setup Propel
require_once 'generated-conf/config.php';

//include route handlers
require_once 'route-handlers/insert_data.php';
require_once 'route-handlers/plain_get.php';
require_once 'route-handlers/reports_by_device_and_day.php';
require_once 'route-handlers/show_report.php';
require_once 'route-handlers/reports_by_device.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('log.txt', Logger::WARNING));

$serviceContainer->setLogger('defaultLogger', $defaultLogger);
