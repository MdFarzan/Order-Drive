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
$routes->match(['get', 'post'], 'site-management/edit-vendor/', 'VendorManagementController::editVendor');
$routes->post('site-management/delete-vendor/', 'VendorManagementController::deleteVendor');

// category management routes
$routes->match(['get', 'post'],'site-management/add-category','CategoryManagement::addCategory');
$routes->get('site-management/all-categories', 'CategoryManagement::index');
$routes->match(['get', 'post'], 'site-management/edit-category', 'CategoryManagement::editCategory');
$routes->post('site-management/delete-category','CategoryManagement::deleteCategory');

// product Management routes
$routes->match(['get', 'post'], 'site-management/add-product', 'ProductManagement::addProduct');
$routes->get('site-management/all-products', 'ProductManagement::index');
$routes->match(['get', 'post'], 'site-management/edit-product', 'ProductManagement::editProduct');
$routes->post('site-management/delete-product', 'ProductManagement::deleteProduct');

// order management routes
$routes->get('site-management/all-orders/', 'OrderManagement::index');
$routes->get('site-management/get-orderedItems/', 'OrderManagement::getOrderedItems');
$routes->get('site-management/new-orders/', 'OrderManagement::getNewOrders');
// route to change order status to processing
$routes->post('site-management/setOrderStatusToProcessing', 'OrderManagement::changeStatustoProcessing');
$routes->get('site-management/pending-orders/', 'OrderManagement::getPendingOrders');
// route to change order status to diffent states
$routes->post('site-management/changeOrderStatus', 'OrderManagement::changeOrderStatus');

// reports routes
$routes->get('site-management/sales-report/', 'ReportsManagement::getSalesReport');
$routes->get('site-management/revenue-report/', 'ReportsManagement::getRevenueReport');



// vendor sign in/out routes
$routes->post('vendor-sign-in/', 'VendorAuthController::index');
$routes->get('vendor/dashboard', 'VendorAuthController::getVendorView');

// order placement routes
$routes->get('vendor/place-order', 'VendorController::placeOrder');
$routes->get('vendor/place-order/category/(:any)', 'VendorController::getCategory/$1');
$routes->get('vendor/place-order/product', 'VendorController::getProduct');
$routes->get('vendor/place-order/search', 'VendorController::findProduct');
$routes->get('cart/', 'VendorController::getCart');
$routes->get('fillCart/', 'VendorController::fillCart');
$routes->post('create-order/', 'VendorController::createOrder');

// for getting order details
$routes->get('vendor/order-history',"OrderDetailController::index");

// for getting product list
$routes->get('vendor/get-list',"OrderDetailController::getProductList");

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
