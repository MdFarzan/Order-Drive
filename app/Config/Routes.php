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
$routes->setDefaultController('Home');
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
$routes->get('/', 'Home::index');
$routes->get('/site-management/dashboard','SiteManagement::index');
$routes->post('admin-sign-in/','AdminAuthController::index');
$routes->get('site-management/signout/','SiteManagement::signout');

//admin management routes
$routes->match(['get','post'],'site-management/add-admin/','AdminManagement::adminCreation');
$routes->get('/site-management/all-admin/', 'AdminManagement::allAdmins');
$routes->match(['get', 'post'], 'site-management/edit-admin', 'AdminManagement::editAdmin');
$routes->post('/site-management/delete-admin/', 'AdminManagement::deleteAdmin');

// vendor management routes
$routes->match(['get', 'post'], 'site-management/add-vendor/', 'VendorManagementController::vendorCreation');
$routes->get('site-management/all-vendor/', 'VendorManagementController::index');

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
