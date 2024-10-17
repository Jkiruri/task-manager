<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\Api\TaskController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|-------------------------------------------------------------------------- 
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Grouping routes under the API prefix
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/tasks', [TaskController::class, 'index']);       // Get all tasks (with filters)
    $router->post('/tasks', [TaskController::class, 'store']);      // Create a new task
    $router->get('/tasks/{id}', [TaskController::class, 'show']);     // Get a specific task
    $router->put('/tasks/{id}', [TaskController::class, 'update']); // Update a specific task
    $router->delete('/tasks/{id}', [TaskController::class, 'destroy']); // Delete a specific task
});
