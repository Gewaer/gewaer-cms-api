<?php

declare(strict_types=1);

namespace Gewaer\Providers;

use function Canvas\Core\appPath;
use Canvas\Providers\RouterProvider as CanvasRouterProvider;

class RouterPublisherProvider extends CanvasRouterProvider
{
    /**
     * Returns the array for all the routes on this system.
     *
     * @return array
     */
    protected function getRoutes(): array
    {
        $pathCms = appPath('api-publisher/routes');

        //app routes
        $routes = [
            'apipublisher' => $pathCms . '/api.php',
        ];

        return $routes;
    }
}
