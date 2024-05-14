<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LandingPage');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LandingPage::index');

// Route Group to protect Admin from Accessing if not logged in
// $routes ->group('',['filter'=>'AuthCheck'], function($routes) {
// 	$routes -> get('/AdminHome/index', 'AdminHome::index');
// 	$routes -> get('/AdminHome', 'AdminHome::index');
// 	$routes -> get('/AdminApplicantProfiles/index', 'AdminApplicantProfiles::index');
// 	$routes -> get('/AdminApplicantProfiles', 'AdminApplicantProfiles');
// 	$routes -> get('/AdminApplicantProfiles/verify', 'AdminApplicantProfiles::verify');
// 	$routes -> get('/AdminEmployerProfiles/index', 'AdminEmployerProfiles::index');
// 	$routes -> get('/AdminEmployerProfiles', 'AdminEmployerProfiles');
// 	$routes -> get('/AdminEmployerProfiles/verify', 'AdminEmployerProfiles::verify');

// 	//Add this route to protect the user from accessing login page when already signed in
// 	// $routes -> get('/Admin', 'Admin::index');
// });

// //Route Group to protect the user from going to Login while already logged in
// $routes ->group('',['filter'=>'AdminLoginCheck'], function($routes) {
// 	//Add this route to protect the user from accessing login page when already signed in
// 	$routes -> get('/Admin/index', 'Admin::index');
// 	$routes -> get('/Admin', 'Admin');
// 	$routes -> get('/admin/index', 'admin::index');
// 	// $routes -> get('/admin', 'admin');
	

// });


//Route Group to protect Applicant/Employer from accessing if not logged in
// Route Group to protect Admin from Accessing if not logged in
// $routes ->group('',['filter'=>'LoginCheck'], function($routes) {
// 	$routes -> get('/ApplicantHome/index', 'ApplicantHome::index');
// 	$routes -> get('/ApplicantHome', 'ApplicantHome');
	
// 	$routes -> get('/MyProfileApplicant/index', 'MyProfileApplicant::index');
// 	$routes -> get('/MyProfileApplicant', 'MyProfileApplicant');

// 	//Add this route to protect the user from accessing login page when already signed in
// 	// $routes -> get('/Admin', 'Admin::index');
// });

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
