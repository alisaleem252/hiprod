<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
*/
Route::get('/', array(
    'as'    => 'home',
    'uses'  => 'home@index'
));

Router::register(array('GET', 'POST'), 'login', array(
    'as'    => 'client-login',
    'uses'  => 'home@login'
));

Router::register(array('GET', 'POST'), 'register', array(
    'as'    => 'client-register',
    'uses'  => 'home@register'
));

/**
 * Update Client Account Information.
 */
Router::register(array('GET', 'POST'), 'account', array(
    'as'    => 'client-account',
    'uses'  => 'home@account'
));

/**
 * User Logout
 */
Route::get('logout', array(
    'as'    => 'logout',
    'uses'  => 'home@logout'
));

/**
 * ASI Quickcheck
 */
Route::get('ajax/asi-quickcheck/(:num)', array(
    'uses'  => 'ajax@asi_quickcheck'
));

/**
 * User Dashboard
 */
Route::get('client/dashboard', array(
    'as'    => 'client-dashboard',
    'before'=> 'auth',
    'uses'  => 'home@dashboard'
));

/**
 * Client's Products
 */
Route::get('client/products', array(
    'as'    => 'client-products',
    'before'=> 'auth',
    'uses'  => 'product@index'
));

Router::register(array('GET', 'POST'), 'client/products/edit/(:num)', array(
    'as'    => 'client-products-edit',
    'uses'  => 'product@edit'
));


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{    
	if (Auth::guest()) return Redirect::to('login');
});