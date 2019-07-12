<?php

use Gewaer\Bootstrap\ApiPublisher;

require_once __DIR__ . '/../../library/Core/autoload.php';

$bootstrap = new ApiPublisher();

$bootstrap->setup();
$bootstrap->run();
