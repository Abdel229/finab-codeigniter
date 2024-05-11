<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/programmation', 'Home::programmation');
$routes->get('/partners', 'Home::partners');
$routes->get('/actualite', 'Home::actualite');
$routes->get('/single-actualite/(:num)', 'Home::singleActualite/$1');
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
    $routes->get('fetcharticles','Admin::fetcharticles');
    $routes->get('galleries/fetchGalleriesAndCategories', 'Admin::fetchGalleriesAndCategories');
    $routes->get('galeries','Admin::galeries');
    $routes->get('categories','ArticlesCategoryController::index');
    $routes->get('categories-gallerie','GalleriesCategoryController::index');



});

/**
 * ***************
 * new
 * *************
 */

$routes->group('/articles',function(RouteCollection $routes) {
    // $routes->get('/', 'ArticleController::index');
    $routes->match(['get','post'],'store', 'ArticleController::store');
    $routes->get('show/(:num)', 'ArticleController::show/$1');
    $routes->match(['GET','POST'],'update/(:num)', 'ArticleController::update/$1');
    $routes->get('delete/(:num)', 'ArticleController::delete/$1');
});

$routes->group('/galleries',function(RouteCollection $routes) {
    $routes->get('/', 'GalleriesController::index');
    $routes->match(['get','post'],'store', 'GalleriesController::store');
    $routes->match(['GET','POST'],'update/(:num)', 'GalleriesController::updateGallery/$1');
    $routes->get('show/(:num)', 'GalleriesController::show/$1');
    $routes->get('per-categorie/(:num)', 'GalleriesController::perCategorie/$1');
    $routes->get('delete/(:num)', 'GalleriesController::deleteGallery/$1');
    $routes->get('delete_image/(:num)', 'GalleriesController::delete/$1');
});

$routes->get('/create_gallery', 'GalleriesController::index');
$routes->get('/fetchCategories', 'GalleriesController::fetchCategories');
$routes->post('/galleries/store', 'GalleriesController::store');
$routes->post('gallery/showImagesByCategory', 'GalleriesController::showImagesByCategory');



$routes->get('/create_article_categories', 'ArticlesCategoryController::index');
$routes->get('/fetchAllCategories', 'ArticlesCategoryController::fetchAll');
$routes->match(['GET','POST'],'/article_categorie/store', 'ArticlesCategoryController::store');
$routes->get('article_category/edit', 'ArticlesCategoryController::edit/$1');
$routes->match(['GET','POST'],'/categories/update/(:num)', 'ArticlesCategoryController::update/$1');
$routes->get('/categories/delete/(:num)', 'ArticlesCategoryController::delete/$1');


$routes->get('/create_gallery_categories', 'GalleriesCategoryController::index');
$routes->get('/fetGalleriesCategories', 'GalleriesCategoryController::fetGalleriesCategories');
$routes->match(['get','post'],'/gallery_categorie/store', 'GalleriesCategoryController::store');
$routes->match(['get','post'],'/galleries_category/update/(:num)', 'GalleriesCategoryController::update/$1');
$routes->get('/galleries_category/delete/(:num)', 'GalleriesCategoryController::delete/$1');

$routes->group('auth', function (RouteCollection $routes) {
    $routes->match(['get','post'],'login','AuthController::login');
    $routes->match(['get','post'],'register','AuthController::register');
    $routes->get('logout','AuthController::logout');
});


/**
 * User management
 */
$routes->group('users', function (RouteCollection $routes) {
    $routes->get('/', 'UsersController::index');
    $routes->match(['GET','POST'],'store', 'UsersController::store');
    $routes->match(['GET','POST'],'update/(:num)', 'UsersController::update/$1');
    $routes->get('delete/(:num)', 'UsersController::delete/$1');
    $routes->get('block/(:num)', 'UsersController::block/$1');
    $routes->get('unblock/(:num)', 'UsersController::unblock/$1');
    $routes->get('show/(:num)', 'UsersController::show/$1');
});







$routes->group('partner',function (RouteCollection $routes){
    $routes->get('/', 'PartenerController::index');
    $routes->get('demande', 'PartenerController::index_demande');
    $routes->get('fetchParters', 'PartenerController::fetchParters');
    $routes->get('list', 'PartenerController::index_partners');
    $routes->match(['GET','POST'],'store', 'PartenerController::store');
    $routes->match(['GET','POST'],'update/(:num)', 'PartenerController::update/$1');
    $routes->get('delete/(:num)','PartenerController::delete/$1');
});


$routes->get('/events', 'EventController::index');

$routes->group('contacts',function (RouteCollection $routes){
    $routes->get('/', 'ContactsController::index');
});
$routes->group('messages',function (RouteCollection $routes){
    $routes->get('/', 'MessagesController::index');
    $routes->post('store', 'MessagesController::store');
});
$routes->get('/messages', 'MessageController::index');



$routes->get('/newsletters', 'NewslettersController::index_historique');
$routes->get('/newsletters/followers', 'NewslettersController::index_followers');
$routes->get('/newsletters/categories', 'NewslettersController::index_categories');


$routes->get('/others', 'OthersController::index_logo');
$routes->get('/others/promotteur', 'OthersController::index_promotteur');
$routes->get('/others/configuration', 'OthersController::index_configuration');


$routes->get('/finab', 'FinabController::index');
$routes->get('/finab/edition', 'FinabController::index_edition_finab');


$routes->get('api/get_data', 'Api::get_data');