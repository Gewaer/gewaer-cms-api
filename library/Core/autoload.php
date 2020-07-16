<?php

require __DIR__ . '/../../vendor/autoload.php';

use function Baka\appPath;
use Dotenv\Dotenv;
use Phalcon\Loader;

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
$dotenv = Dotenv::createImmutable(appPath());
$dotenv->load();
