<?php

use App\Controllers\PostController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/posts', 'PostController::index');
// $routes->post('/posts', 'PostController::store');
$routes->post('/posts', [PostController::class, 'store']);
$routes->put('/posts', 'PostController::update');
$routes->delete('/posts/(:num)', 'PostController::destroy/$1');
// $routes->put('/posts', [PostController::class, 'store']);
// $routes->get('/posts', function ($request){
//     return 'Hello World';
// });
