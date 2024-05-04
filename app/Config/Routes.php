<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/programmation', 'Home::programmation');
$routes->get('/partners', 'Home::partners');
$routes->get('/actualite', 'Home::actualite');
$routes->get('/media', 'Home::media');
$routes->get('/contact', 'Home::contact');


$routes->post('sendMail','Mail::sendMail');



$routes->group('/latest', function (RouteCollection $routes) {
    $routes->get('/','latest::index');
    $routes->get('qui','latest::qui');
    $routes->get('partenaire','latest::partenaire');
    $routes->get('programmation','latest::programmation');
    $routes->get('media','latest::media');
    $routes->get('portfolio','latest::portfolio');
    $routes->get('contact','latest::contact');
});


$routes->group('/admin', function (RouteCollection $routes) {
    $routes->get('/','Admin::index');
});


/**
 * ***************
 * new
 * *************
 */

$routes->group('/articles',function(RouteCollection $routes) {
    $routes->get('/', 'ArticleController::index');
    $routes->post('da/store', 'ArticleController::store');
    $routes->get('show/(:num)', 'ArticleController::show/$1');
});




$routes->get('/create_gallery', 'GalleriesController::index');
$routes->get('/fetchCategories', 'GalleriesController::fetchCategories');
$routes->post('/galleries/store', 'GalleriesController::store');
$routes->post('gallery/showImagesByCategory', 'GalleriesController::showImagesByCategory');



$routes->get('/create_article_categories', 'ArticlesCategoryController::index');
$routes->post('/article_categorie/store', 'ArticlesCategoryController::store');
$routes->get('article_category/edit', 'ArticlesCategoryController::edit/$1');
$routes->post('/categories/update/(:num)', 'ArticlesCategoryController::update/$1');
$routes->get('/categories/delete/(:num)', 'ArticlesCategoryController::delete/$1');


$routes->get('/create_gallery_categories', 'GalleriesCategoryController::index');
$routes->post('/gallery_categorie/store', 'GalleriesCategoryController::store');
$routes->get('gallery_category/edit', 'GalleriesCategoryController::edit/$1');
$routes->post('/galleries_category/update/(:num)', 'GalleriesCategoryController::update/$1');
$routes->get('/galleries_category/delete/(:num)', 'GalleriesCategoryController::delete/$1');