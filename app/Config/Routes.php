<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'ArticleController::index');
$routes->post('/articles/store', 'ArticleController::store');
$routes->get('show/(:num)', 'ArticleController::show/$1');



$routes->get('/create_gallery', 'GalleriesController::index');
$routes->post('/galleries/store', 'GalleriesController::store');