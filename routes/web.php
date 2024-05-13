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

//API routes for site 1
//$router->get('/users1', ['uses' => 'User1Controller@getUsers']); //good
$router->get('/users1/{id}', ['uses' => 'User1Controller@show']);
$router->get('/users1', 'User1Controller@index');

$router->post('/users1', ['uses' => 'User1Controller@add']); // good
// Add routes for PUT, PATCH, and HEAD methods
$router->put('/users1/{id}', ['uses' => 'User1Controller@update']); //
$router->patch('/users1/{id}', ['uses' => 'User1Controller@update']); //updates all

// Additional routes for demonstration purposes
$router->delete('/users1/{id}', ['uses' => 'User1Controller@delete']); //
$router->options('/users1', ['uses' => 'User1Controller@options']);

//--------------------------------------------------------------------------

//API routes for site 2
//$router->get('/users2', ['uses' => 'Use2Controller@getUsers']); //good=
$router->get('/users2/{id}', ['uses' => 'User2Controller@show']);
$router->get('/users2', 'User2Controller@index');

$router->post('/users2', ['uses' => 'User2Controller@add']); // good
// Add routes for PUT, PATCH, and HEAD methods
$router->put('/users2/{id}', ['uses' => 'User2Controller@update']); //does the job but changes create date
$router->patch('/users2/{id}', ['uses' => 'User2Controller@update']); //updates all

// Additional routes for demonstration purposes
$router->delete('/users2/{id}', ['uses' => 'User2Controller@delete']); //
$router->options('/users2', ['uses' => 'User2Controller@options']);