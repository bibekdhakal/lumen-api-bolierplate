<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => ['cors']], function () use ($router) {
    $router->group(['middleware' => ['auth:api']], function () use ($router) {
    $router->get('users',  ['uses' => 'Api\UserController@index']);
    $router->get('users/{id}',  ['uses' => 'Api\UserController@show']);
    $router->put('users/{id}',  ['uses' => 'Api\UserController@store']);
    $router->delete('users/{id}',  ['uses' => 'Api\UserController@destroy']);
  });
  $router->post('login', 'Api\AuthController@login');
  $router->post('users',  ['uses' => 'Api\UserController@store']);
});

$router->get('/debug-sentry', function () {
  throw new Exception('My first Sentry error!');
});
