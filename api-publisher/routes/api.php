<?php

use Baka\Router\RouteGroup;
use Baka\Router\Route;

$routes = [
    Route::get('/')->controller('IndexController'),
    Route::get('/status')->controller('IndexController')->action('status'),
    Route::post('/auth')->controller('AuthController')->action('login')

];

$routesSite = [
    Route::get('/posts')->action('index'),
    Route::post('/posts/{id}/like')->controller('PostsController')->action('addOrRemoveLike')
];

$routeGroup = RouteGroup::from($routes)
                ->defaultNamespace('Gewaer\Api\Publisher\Controllers')
                ->defaultPrefix('/v1');

$privateRoutesGroup = RouteGroup::from($routesSite)
                ->defaultNamespace('Gewaer\Api\Publisher\Controllers')
                ->addMiddlewares('auth.site@before')
                ->defaultPrefix('/v1');

return array_merge($routeGroup->toCollections(), $privateRoutesGroup->toCollections());
