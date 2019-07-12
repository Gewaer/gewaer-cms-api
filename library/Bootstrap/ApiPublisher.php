<?php

declare(strict_types=1);

namespace Gewaer\Bootstrap;

use function Canvas\Core\appPath;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;
use Canvas\Bootstrap\Api as CanvasApiBoostrap;

/**
 * Class Api.
 *
 * @package Canvas\Bootstrap
 *
 * @property Micro $application
 */
class ApiPublisher extends CanvasApiBoostrap
{

    /**
     * @return mixed
     */
    public function setup()
    {
        //set the default DI
        $this->container = new FactoryDefault();
        //set all the services

        /**
        * @todo Find a better way to handle unit test file include
        */
        $this->providers =  require appPath('api-publisher/config/providers.php');

        //call them directly
        $this->container->set('metrics', microtime(true));
        $this->setupApplication();
        $this->registerServices();
    }
}
