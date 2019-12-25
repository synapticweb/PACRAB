<?php

// setup the autoloading
require_once 'vendor/autoload.php';

// setup Propel
require_once 'generated-conf/config.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('log.txt', Logger::WARNING));

$serviceContainer->setLogger('defaultLogger', $defaultLogger);