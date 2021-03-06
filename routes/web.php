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
$router->options(
    '/{any:.*}',
    [
        function (){
            return response(['status' => 'success']);
        }
    ]
);
$router->post('/register', 'UserController@store');
$router->post('/authenticate','UserController@authenticate');
$router->group(['prefix' => 'api/v1'], function () use ($router){
    $router->get('/tasks', 'TaskController@index');
    $router->post('/tasks', 'TaskController@store');
    $router->get('/tasks/{id}', 'TaskController@show');
    $router->patch('/tasks/{id}', 'TaskController@update');
    $router->delete('/tasks/{id}', 'TaskController@destroy');
});
