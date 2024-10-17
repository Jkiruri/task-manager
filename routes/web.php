<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\TaskController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('tasks', 'TaskController@store'); // Create a Task
    $router->get('tasks', 'TaskController@index'); // Get All Tasks
    $router->get('tasks/{id}', 'TaskController@show'); // Get a Specific Task
    $router->put('tasks/{id}', 'TaskController@update'); // Update a Task
    $router->delete('tasks/{id}', 'TaskController@destroy'); // Delete a Task
});
