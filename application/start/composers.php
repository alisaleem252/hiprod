<?php
/**
 * Client View Composer
 */
View::composer('layouts.default', function($view){       
    $view->nest('header',  'partials.header');
    $view->nest('content', 'partials.content');
    $view->nest('footer',  'partials.footer');
    $view->nest('sidebar', 'partials.sidebar');
});

View::composer('home.login', function($view){
    $view->nest('loginForm',  'partials.forms.login.client');
});

View::composer('home.register', function($view){
    $view->nest('registrationForm', 'partials.forms.register.client');
});

View::composer('home.account', function($view){        
    $view->nest('form', 'partials.forms.account.edit', array('client' => $view->client));
});

View::composer('product.index', function($view){
    $view->nest('search_form', 'partials.forms.product.search');
});

/**
 * Admin View Composer
 */
View::composer('admin::layouts.default', function($view){       
    $view->nest('header',  'admin::partials.header');
    $view->nest('content', 'admin::partials.content');
    $view->nest('footer',  'admin::partials.footer');
});


/**
 * Admin View Composer
 */
View::composer('admin::home.login', function($view){
    $view->nest('loginForm',  'admin::partials.forms.login.employee');
});


/**
 * View HiProd Vendor LIst
 */
View::composer('admin::product.index', function($view){
    $view->nest('search_form',  'admin::partials.forms.product.index');
});

/**
 * View HiProd Vendor LIst
 */
View::composer('admin::product.add', function($view){
    $view->nest('search_form',  'admin::partials.forms.product.add');
});

/**
 * View HiProd Vendor LIst
 */
View::composer('admin::vendor.index', function($view){
    $view->nest('search_form',  'admin::partials.forms.vendor.index');
});

/**
 * Seach ASI for vendor record.
 */
View::composer('admin::vendor.add', function($view){
    $view->nest('search_form',  'admin::partials.forms.vendor.add');
});

/**
 * View HiProd Client LIst
 */
View::composer('admin::client.index', function($view){
    $view->nest('search_form',  'admin::partials.forms.client.index');
});

View::composer('admin::client.add', function($view){
    $view->nest('form',  'admin::partials.forms.client.add');
});

View::composer('admin::client.edit', function($view){        
    $view->nest('form',  'admin::partials.forms.client.edit', array('client' => $view->client));
});