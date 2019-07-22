<?php

use Baka\Router\RouteGroup;
use Baka\Router\Route;

$routes = [
    Route::get('/')->controller('IndexController'),
    Route::get('/status')->controller('IndexController')->action('status'),
];

$routesSite = [
    Route::get('/posts')->action('index')
];

$routeGroup = RouteGroup::from($routes)
                ->defaultNamespace('Gewaer\Api\Publisher\Controllers')
                ->defaultPrefix('/v1');

$privateRoutesGroup = RouteGroup::from($routesSite)
                ->defaultNamespace('Gewaer\Api\Publisher\Controllers')
                ->addMiddlewares('auth.jwt@before', 'auth.acl@before')
                ->addMiddlewares('auth.site@before')
                ->defaultPrefix('/v1');

return array_merge($routeGroup->toCollections(), $privateRoutesGroup->toCollections());
