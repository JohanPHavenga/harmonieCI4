<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('script/(:segment)', 'Script::$1');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Contact::index');
$routes->post('contact', 'Contact::index');

$routes->post('property/search', 'Property::search');
$routes->get('property/(:segment)', 'Property::grid/$1');
$routes->post('property/(:segment)', 'Property::grid/$1');
$routes->get('property/detail/(:segment)', 'Property::detail/$1');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Dashboard::view');

    $routes->get('property', 'Property::view');
    $routes->get('property/create/(:any)', 'Property::create/$1');
    $routes->post('property/create/(:any)', 'Property::create/$1');
    $routes->get('property/delete/(:any)', 'Property::delete/$1');

    $routes->get('location', 'Location::view');
    $routes->get('location/create/(:any)', 'Location::create/$1');
    $routes->post('location/create/(:any)', 'Location::create/$1');
    $routes->get('location/delete/(:any)', 'Location::delete/$1');

    $routes->get('type', 'Type::view');
    $routes->get('type/create/(:any)', 'Type::create/$1');
    $routes->post('type/create/(:any)', 'Type::create/$1');
    $routes->get('type/delete/(:any)', 'Type::delete/$1');

    $routes->get('user', 'User::view');
    $routes->get('user/create/(:any)', 'User::create/$1');
    $routes->post('user/create/(:any)', 'User::create/$1');
    $routes->get('user/delete/(:any)', 'User::delete/$1');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
