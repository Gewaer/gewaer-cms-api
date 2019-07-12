<?php

use Dotenv\Dotenv;
use Phalcon\Loader;
use function Canvas\Core\appPath;

// Register the auto loader
//require __DIR__ . '/functions.php';
require '/canvas-core/src/Core/functions.php';
//require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . '/vendor/canvas/core/src/Core/functions.php';

$loader = new Loader();
$namespaces = [
    'Canvas' => '/canvas-core/src',
    'Baka\Auth' => '/baka/auth/src',
    'Baka\Database' => '/baka/database/src',
    'Baka\Elasticsearch' => '/baka/elasticsearch/src',
    'Baka\Http' => '/baka/http/src',
    'Phalcon\Cashier' => '/baka/cashier/src',
    'Baka\Mail' => '/baka/mail/src',
    'Baka\Blameable' => '/baka/blameable/src',
    'Baka\Support' => '/baka/support/src',
    'Baka\Router' => '/baka/router/src',

    'Gewaer' => appPath('/library'),
    'Gewaer\Api\Controllers' => appPath('/api/controllers'),
    'Gewaer\Api\Publisher\Controllers' => appPath('/api-publisher/controllers'),
    'Gewaer\Cli\Tasks' => appPath('/cli/tasks'),
    'Niden\Tests' => appPath('/tests'),
    'Gewaer\Tests' => appPath('/tests')
];
$loader->registerNamespaces($namespaces);

$loader->register();

/**
 * Composer Autoloader.
 */
require appPath('vendor/autoload.php');

// Load environment
(new Dotenv(appPath()))->overload();
