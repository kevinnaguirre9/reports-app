<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/academic-periods', [
    'as'    => 'academic-periods.create',
    'uses'  => 'AcademicPeriodPostController'
]);

$router->get('/academic-periods', [
    'as'    => 'academic-periods.getAll',
    'uses'  => 'AcademicPeriodGetAllController'
]);

$router->get('/academic-periods/{id}', [
    'as'    => 'academic-periods.get',
    'uses'  => 'AcademicPeriodGetController'
]);

$router->post('/data-sources', [
    'as'    => 'data-sources.create',
    'uses'  => 'DataSourcePostController'
]);

$router->get('/data-sources', [
    'as'    => 'data-sources.getAll',
    'uses'  => 'DataSourceGetAllController'
]);

$router->get('/test', [
    'as'    => 'test.testGCS',
    'uses'  => 'TestDocPostController'
]);
