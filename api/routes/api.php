<?php

use Baka\Router\RouteGroup;
use Baka\Router\Route;

$routes = [
    Route::get('/')->controller('IndexController'),
    Route::get('/status')->controller('IndexController')->action('status'),
];

$privateRoutes = [
    Route::crud('/posts'),
    Route::crud('/tags'),
    Route::crud('/posts-status')->controller('StatusController'),
    Route::crud('/categories'),
    Route::crud('/posts-tags')->controller('PostsTagsController'),
    Route::crud('/posts-types')->controller('PostsTypesController'),
    Route::crud('/tournaments-groups')->controller('TournamentGroupsController'),
    Route::crud('/tournaments-groups-teams')->controller('TournamentGroupsTeamsController'),
    Route::crud('/tournaments-matches')->controller('TournamentMatchesController'),
    Route::crud('/tournaments-matches-sources')->controller('TournamentMatchesSourcesController'),
    Route::crud('/tournaments-matches-series')->controller('TournamentMatchSeriesController'),
    Route::crud('/tournaments-seasons')->controller('TournamentSeasonsController'),
    Route::crud('/tournaments-seasons-versions')->controller('TournamentSeasonsVersionsController'),
    Route::crud('/tournaments-series')->controller('TournamentSeriesController'),
    Route::crud('/tournaments-stages')->controller('TournamentStagesController'),
    Route::crud('/tournaments-teams')->controller('TournamentTeamsController'),
    Route::crud('/tournaments-types')->controller('TournamentTypesController'),
    Route::crud('/tournaments-versions')->controller('TournamentVersionsController'),
    Route::crud('/currencies')->controller('CurrenciesController'),
    Route::crud('/sources')->controller('SourcesController'),
    Route::crud('/teams')->controller('TeamsController')
];

$routeGroup = RouteGroup::from($routes)
                ->defaultNamespace('Gewaer\Api\Controllers')
                ->defaultPrefix('/v1');

$privateRoutesGroup = RouteGroup::from($privateRoutes)
                ->defaultNamespace('Gewaer\Api\Controllers')
                ->addMiddlewares('auth.jwt@before', 'auth.acl@before', 'cms.site@before')
                ->defaultPrefix('/v1');

return array_merge($routeGroup->toCollections(), $privateRoutesGroup->toCollections());
