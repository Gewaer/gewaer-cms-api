<?php

use Baka\Router\RouteGroup;
use Baka\Router\Route;

$routes = [
    Route::get('/')->controller('IndexController'),
    Route::get('/status')->controller('IndexController')->action('status'),
    Route::post('/auth')->controller('AuthController')->action('login')

];

$routesSite = [
    Route::get('/users/{id}')->controller('UsersController')->action('getById'),
    Route::get('/posts')->action('index'),
    Route::post('/posts/{id}/like')->controller('PostsController')->action('like'),
    Route::get('/tournaments-groups')->controller('TournamentGroupsController')->action('index'),
    Route::get('/tournaments-groups/{id}')->controller('TournamentGroupsController')->action('getById'),
    Route::get('/tournaments-groups-teams')->controller('TournamentGroupsTeamsController')->action('index'),
    Route::get('/tournaments-groups-teams/{id}')->controller('TournamentGroupsTeamsController')->action('getById'),
    Route::get('/tournaments-matches')->controller('TournamentMatchesController')->action('index'),
    Route::get('/tournaments-matches/{id}')->controller('TournamentMatchesController')->action('getById'),
    Route::get('/tournaments-matches-sources')->controller('TournamentMatchesSourcesController')->action('index'),
    Route::get('/tournaments-matches-sources/{id}')->controller('TournamentMatchesSourcesController')->action('getById'),
    Route::get('/tournaments-matches-series')->controller('TournamentMatchSeriesController')->action('index'),
    Route::get('/tournaments-matches-series/{id}')->controller('TournamentMatchSeriesController')->action('getById'),
    Route::get('/tournaments-seasons')->controller('TournamentSeasonsController')->action('index'),
    Route::get('/tournaments-seasons/{id}')->controller('TournamentSeasonsController')->action('getById'),
    Route::get('/tournaments-seasons-versions')->controller('TournamentSeasonsVersionsController')->action('index'),
    Route::get('/tournaments-seasons-versions/{id}')->controller('TournamentSeasonsVersionsController')->action('getById'),
    Route::get('/tournaments-series')->controller('TournamentSeriesController')->action('index'),
    Route::get('/tournaments-series/{id}')->controller('TournamentSeriesController')->action('getById'),
    Route::get('/tournaments-stages')->controller('TournamentStagesController')->action('index'),
    Route::get('/tournaments-stages/{id}')->controller('TournamentStagesController')->action('getById'),
    Route::get('/tournaments-teams')->controller('TournamentTeamsController')->action('index'),
    Route::get('/tournaments-teams/{id}')->controller('TournamentTeamsController')->action('getById'),
    Route::get('/tournaments-types')->controller('TournamentTypesController')->action('index'),
    Route::get('/tournaments-types/{id}')->controller('TournamentTypesController')->action('getById'),
    Route::get('/tournaments-versions')->controller('TournamentVersionsController')->action('index'),
    Route::get('/tournaments-versions/{id}')->controller('TournamentVersionsController')->action('getById'),
    Route::get('/currencies')->controller('CurrenciesController'),
    Route::get('/currencies/{id}')->controller('CurrenciesController')->action('getById'),
    Route::get('/sources')->controller('SourcesController'),
    Route::get('/sources/{id}')->controller('SourcesController')->action('getById')
];

$routeGroup = RouteGroup::from($routes)
                ->defaultNamespace('Gewaer\Api\Publisher\Controllers')
                ->defaultPrefix('/v1');

$privateRoutesGroup = RouteGroup::from($routesSite)
                ->defaultNamespace('Gewaer\Api\Publisher\Controllers')
                ->addMiddlewares('auth.site@before')
                ->defaultPrefix('/v1');

return array_merge($routeGroup->toCollections(), $privateRoutesGroup->toCollections());
