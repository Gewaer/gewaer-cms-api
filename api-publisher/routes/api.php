<?php

use Baka\Router\RouteGroup;
use Baka\Router\Route;

$routes = [
    Route::get('/')->controller('IndexController'),
    Route::get('/status')->controller('IndexController')->action('status'),
    Route::post('/auth')->controller('AuthController')->action('login'),
    Route::get('/teams')->controller('TeamsController')->action('index'),
    Route::get('/teams/{id}')->controller('TeamsController')->action('getById'),
    Route::get('/games')->controller('GamesController')->action('index'),
    Route::get('/games/{id}')->controller('GamesController')->action('getById'),
    Route::get('/countries')->controller('CountriesController')->action('index'),
    Route::get('/countries/{id}')->controller('CountriesController')->action('getById'),
    Route::get('/regions-countries')->controller('RegionsCountriesController')->action('index'),
    Route::get('/regions-countries/{id}')->controller('RegionsCountriesController')->action('getById'),
    Route::get('/regions')->controller('RegionsController')->action('index'),
    Route::get('/regions/{id}')->controller('RegionsController')->action('getById'),
    Route::get('/leagues')->controller('LeaguesController')->action('index'),
    Route::get('/leagues/{id}')->controller('LeaguesController')->action('getById'),
    Route::get('/organizations')->controller('OrganizationsController')->action('index'),
    Route::get('/organizations/{id}')->controller('OrganizationsController')->action('getById'),
    Route::post('/users')->controller('AuthController')->action('signup'),
    Route::get('/posts-tournament-matches')->controller('PostsTournamentMatchesController')->action('index'),
    Route::get('/posts-tournament-matches/{id}')->controller('PostsTournamentMatchesController')->action('getById'),
];

$routesSite = [
    Route::get('/users/{id}')->controller('UsersController')->action('getById'),
    Route::get('/posts')->action('index'),
    Route::get('/posts/{id}')->action('getById'),
    Route::post('/posts/{id}/like')->controller('PostsController')->action('like'),
    Route::get('/posts/live')->controller('PostsController')->action('getCurrentLivePost'),
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
    Route::get('/sources/{id}')->controller('SourcesController')->action('getById'),
    Route::crud('/users-tags')->controller('UsersFollowingTagsController'),
    Route::delete('/users/{id}/tags/{tagsId}')->controller('UsersFollowingTagsController')->action('delete'),
    Route::post('/posts-shares')->controller('PostsSharesController'),
    Route::get('/comments')->action('index'),
    Route::post('/posts/{id}/comment')->controller('CommentsController')->action('add'),
    Route::get('/posts/users')->controller('PostsController')->action('getAllUsersTagsPosts')
];

$routeGroup = RouteGroup::from($routes)
                ->defaultNamespace('Gewaer\Api\Publisher\Controllers')
                ->defaultPrefix('/v1');

$privateRoutesGroup = RouteGroup::from($routesSite)
                ->defaultNamespace('Gewaer\Api\Publisher\Controllers')
                ->addMiddlewares('auth.site@before')
                ->defaultPrefix('/v1');

return array_merge($routeGroup->toCollections(), $privateRoutesGroup->toCollections());
