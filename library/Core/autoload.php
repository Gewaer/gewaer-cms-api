<?php

use Dotenv\Dotenv;
use Phalcon\Loader;
use function Canvas\Core\appPath;

// Register the auto loader
require '/canvas-core/src/Core/functions.php';

$loader = new Loader();
$namespaces = [
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
