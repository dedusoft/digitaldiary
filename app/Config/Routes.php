<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('PageController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('App\Controllers\PageController::error404');
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

/*
 * --------------------------------------------------------------------
 * Route Definitions for rendering the pages
 * --------------------------------------------------------------------
 */

$routes->get('/', 'PageController::index', ["filter" => "noauth"]);

$routes->group('auth', static function ($routes) {
    $routes->get('login', 'PageController::login', ["filter" => "noauth"]);
    $routes->get('logout', 'PageController::logout', ["filter" => "auth"]);
    $routes->get('register', 'PageController::register', ["filter" => "noauth"]);
    $routes->get('lock-page', 'PageController::lockPage');
    $routes->get('forgot-password', 'PageController::forgotPassword', ["filter" => "noauth"]);
    $routes->get('reset-password', 'PageController::resetPassword', ["filter" => "noauth"]);
});

$routes->get('dashboard','PageController::dashboard',["filter" => "auth"]);



/*
 * --------------------------------------------------------------------
 * Route Definitions for our REST API
 * --------------------------------------------------------------------
 */
$routes->group('api', static function ($routes) {
    $routes->group('auth', static function ($routes) {
        $routes->post('login', 'AuthAPIController::login');
        $routes->post('register', 'AuthAPIController::register');
        $routes->post('forget-password', 'AuthAPIController::forgetPassword');
        $routes->post('reset-password', 'AuthAPIController::resetPasword');
    });

    // $routes->group('dairy', static function ($routes) {
    //     $routes->get('all', 'DairyController::index');
    // });
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
