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

$router->get('/users', ['uses' => 'UserController@getUsers']); //good
$router->post('/users', ['uses' => 'UserController@add']); // good
// Add routes for PUT, PATCH, and HEAD methods
$router->put('/users/{id}', ['uses' => 'UserController@update']); //does the job but changes create date
$router->patch('/users/{id}', ['uses' => 'UserController@partialUpdate']); //updates all
$router->head('/users/{id}', ['uses' => 'UserController@headUser']); // does nothing
// Additional routes for demonstration purposes
$router->delete('/users/{id}', ['uses' => 'UserController@delete']); //
$router->options('/users', ['uses' => 'UserController@options']);
$router->get('/users/{id}', ['uses' => 'UserController@show']);