<?php
// All admin routes require staff login
Route::filter('pattern: (admin/|admin[^-]).+', 'admin_auth');


Route::get('(:bundle)', array(
    'as'    => 'admin',
    'uses'  => 'admin::home@index'
));

/**
 * Admin Dashboard
 */
Route::get('(:bundle)/dashboard', array(
    'as'    => 'admin-dashboard',
    'uses'  => 'admin::home@dashboard'
));

/**
 * Products
 */
Route::get('(:bundle)/products', array(
    'as'    => 'admin-products',
    'uses'  => 'admin::product@index'
));

Route::get('(:bundle)/products/add', array(
    'as'    => 'admin-products-add',
    'uses'  => 'admin::product@add'
));

Router::register(array('GET', 'POST'), '(:bundle)/products/edit/(:num)', array(
    'as'    => 'admin-products-edit',
    'uses'  => 'admin::product@edit'
));

Route::get('(:bundle)/products/view/(:num)', array(
    'as'    => 'admin-products-view',
    'uses'  => 'admin::product@view'
));

/**
 * Vendors
 */
Route::get('(:bundle)/vendors', array(
    'as'    => 'admin-vendors',
    'uses'  => 'admin::vendor@index'
));

Route::get('(:bundle)/vendors/add', array(
    'as'    => 'admin-vendors-add',
    'uses'  => 'admin::vendor@add'
));

/**
 * Clients
 */
Route::get('(:bundle)/clients', array(
    'as'    => 'admin-clients',
    'uses'  => 'admin::client@index'
));

Router::register(array('GET', 'POST'), '(:bundle)/clients/add', array(
    'as'    => 'admin-clients-add',
    'uses'  => 'admin::client@add'
));

Router::register(array('GET', 'POST'), '(:bundle)/clients/edit/(:num)', array(
    'as'    => 'admin-clients-edit',
    'uses'  => 'admin::client@edit'
));

Route::get('(:bundle)/clients/forced-login/(:num)', array(
    'as'    => 'admin-clients-forced-login',
    'uses'  => 'admin::client@forced_login'
));


/**
 * Admin/Staff Login
 */
Router::register(array('GET', 'POST'), 'admin-login', array(
    'as'    => 'admin-login',
    'uses'  => 'admin::home@login'
));


/**
 * Admin/Staff Logout
 */
Route::get('admin-logout', array(
    'as'    => 'admin-logout',
    'uses'  => 'admin::home@logout'
));

/**
 * Ajax Handling
 */
Route::get('(:bundle)/ajax', array(
    'as'    => 'admin',
    'uses'  => 'admin::ajax@index'
));

Route::post('(:bundle)/ajax/import-vendors', array(
    'uses'  => 'admin::ajax@import_vendors'
));

Route::post('(:bundle)/ajax/import-products', array(
    'uses'  => 'admin::ajax@import_products'
));

Route::post('(:bundle)/ajax/asi-product-search', array(
    'uses'  => 'admin::ajax@asi_product_search'
));




/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
*/

Route::filter('admin_auth', function()
{    
	if ( Auth::driver('ldapauth')->guest() ) return Redirect::to('admin-login');
});

Route::filter('privileged_employee', function()
{
    // Is the user a privileged employee?
    $is_privileged = IoC::resolve('isPrivilegedEmployee');
    
    // Deny if user doesn't not have admin priviledges assigned to them
    if( ! $is_privileged ) return Response::error(404);
});