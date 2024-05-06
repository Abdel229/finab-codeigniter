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
$routes->get('/fetchCategories', 'GalleriesController::fetchCategories');
$routes->post('/galleries/store', 'GalleriesController::store');
$routes->post('gallery/showImagesByCategory', 'GalleriesController::showImagesByCategory');



$routes->get('/create_article_categories', 'ArticlesCategoryController::index');
$routes->post('/article_categorie/store', 'ArticlesCategoryController::store');
$routes->post('/article_categorie/store', 'ArticlesCategoryController::store');
$routes->get('article_category/edit', 'ArticlesCategoryController::edit/$1');
$routes->post('/categories/update/(:num)', 'ArticlesCategoryController::update/$1');
$routes->get('/categories/delete/(:num)', 'ArticlesCategoryController::delete/$1');


$routes->get('/create_gallery_categories', 'GalleriesCategoryController::index');
$routes->post('/gallery_categorie/store', 'GalleriesCategoryController::store');
$routes->get('gallery_category/edit', 'GalleriesCategoryController::edit/$1');
$routes->post('/galleries_category/update/(:num)', 'GalleriesCategoryController::update/$1');
$routes->get('/galleries_category/delete/(:num)', 'GalleriesCategoryController::delete/$1');


$routes->get('/login', 'userController::index');
$routes->post('/auth', 'userController::login');
$routes->get('/logout', 'userController::logout');