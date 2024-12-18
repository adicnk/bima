<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('User');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

//for Front Page Route
$routes->get('/', 'User::index');

//List
$routes->get('/listPenelitian', 'User::listPenelitian');
$routes->get('/listPengabdian', 'User::listPengabdian');

//Detail
$routes->get('/dataPenelitian', 'User::inpl');
$routes->get('/viewPenelitian', 'User::detpl');

//Form 
$routes->get('/submitDosen', 'Submit::dosen');
$routes->get('/addDosen', 'Form::addDosen');
$routes->get('/addPenelitian', 'Form::addPenelitian');
$routes->get('/addPengabdian', 'Form::addPengabdian');
$routes->get('/editPenelitian/$1', 'Form::editPenelitian($1)');
$routes->get('/editPengabdian/$1', 'Form::editPengabdian($1)');

//File
$routes->get('/download', 'User::detpl');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
