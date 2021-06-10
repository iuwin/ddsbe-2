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

//unsecured route
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users',['uses' => 'UserController@getUsers']);
});


//simple route
$router->get('/users', 'UserController@index'); //get all users
$router->post('/users', 'UserController@add'); //add user
$router->get('/users/{id}', 'UserController@show'); //get user by id
$router->put('/users/{id}', 'UserController@update'); //update user record
$router->patch('/users/{id}', 'UserController@update'); //update user record
$router->delete('/users/{id}', 'UserController@delete'); //delete user record




