<?php

/*
|--------------------------------------------------------------------------
| Dynamic Tasks
|--------------------------------------------------------------------------
|
| Dynamically access any task.
|
*/
IoC::register('task', function( $task_file = '' ){

    // Full path to the task file.
    $task_path = path('app') . '/tasks/' . $task_file;

    // Convert dot syntax to slash
    $include_path = str_replace('.', '/', $task_path) . '.php';
    
    // Inclue the task file.
    include_once $include_path;
    
    // Set the task class name
    $task = str_replace('.', '_', $task_file). '_Task';

    return new $task;
});

/*
|--------------------------------------------------------------------------
| Build Time
|--------------------------------------------------------------------------
|
| Fetch the unix timestamp of the latest build.
|
| !! IMPORTANT !!
| I modified the script() and style() methods of Laravel\Html core file. You'll
| see that I added the addition of the build_time to file names which should
| help with caching.
*/

IoC::register('build_time', function(){

    $build_time = Cache::get('build_time', function(){

        $build_task = IoC::resolve('task', array('build'));

        return $build_task->update();

    });

    return $build_time;
});


/*
|--------------------------------------------------------------------------
| Privileged Employees
|--------------------------------------------------------------------------
|
| Employees that can access HiProd but have also been given special rights
| to restricted areas of the admin panel.
| 
*/
IoC::register('privileged_employees', function(){
    
    return Cache::get('privileged_employees', function(){
        
        // Fetch all employss that have administrative privilege
        $user_admins = User_Admin::all(array('username'));
        
        // Convert to json
        $user_admins_json = eloquent_to_json( $user_admins );

        // Conver to json to array
        $user_admin_decoded = json_decode( $user_admins_json );
        
        // Array that will contain usernames of all privileged employees
        $privileged_employees = array();
        
        // Loop through the db results
        foreach($user_admin_decoded as $key => $value)
        {
            // Append to the $privileged_employees array
            $privileged_employees[] = $value->username;
        }
        
        // Store cache record for 30 days.
        Cache::put('privileged_employees', $privileged_employees, (( 60 * 24 ) * 30));
        
        return $privileged_employees;
    });
    
});

/*
|--------------------------------------------------------------------------
| Is user a privileged employee?
|--------------------------------------------------------------------------
|
| The checks if user is either a privileged employee or a super admin.
| 
*/
IoC::register('isPrivilegedEmployee', function(){
        
    $privileged_employees = IoC::resolve('privileged_employees');
    
    // Is the user a privileged employee?
    $is_privileged = in_array( Session::get('username'), $privileged_employees);
    
    // Allow any priviledged employee or super administrator
    return $is_privileged || My_Helper::isAdmin();
});

/*
|--------------------------------------------------------------------------
| SMTP Client
|--------------------------------------------------------------------------
*/
IoC::register('smtp', function(){
    
    return new Zend_Mail_Transport_Smtp( Config::get('email.server') );
});

/*
|--------------------------------------------------------------------------
| Mail Client
|--------------------------------------------------------------------------
*/
IoC::register('adminEmailNotification', function(){
    
    Zend_Mail::setDefaultTransport( IoC::resolve('smtp') );
    
    // Create new instance of zend mail.
    $mail = new Zend_Mail();
    
    // Set who the email will be from
    $mail->setFrom( Config::get('email.from') );
    
    // Return Object
    return $mail;
});

/*
|--------------------------------------------------------------------------
| ASI Rest Api Client
|--------------------------------------------------------------------------
|
| DRY approach to connecting with ASI Central's API server.
*/
    
IoC::register('Asi_Rest_Client', function(){

    // Fetch configuration values from the ASI bundle.
    $api_key    = Config::get('asi::api.api_key');
    $api_secret = Config::get('asi::api.api_secret');
    $api_url    = Config::get('asi::api.api_url');

    // Feth default Zend_Rest_Client configs form the ASI bundle.
    $client_configs = Config::get('asi::api.client_configs');    

    // Create new instance of Zend_Http_Client    
    $httpClient = new Zend_Http_Client( $api_url );
    $httpClient->setHeaders(
        "Authorization",
        "AsiMemberAuth client_id={$api_key}&client_secret={$api_secret}"
    );

    // Create new instance of Zend_Rest_Client
    $restClient = new Zend_Rest_Client( $api_url, $client_configs);
    $restClient->setHttpClient($httpClient);

    // Return the object
    return $restClient;
});

/*
|--------------------------------------------------------------------------
| ASI Supplier Search 
|--------------------------------------------------------------------------
|
| Search ASI Central's API for supplier(s)
|
*/
IoC::register('asiSupplierSearch', function( $asi_number = 0 ){
    
    // Use laravel controlled url generation (enviornment specific)
    $url    = URL::to_route('asi', array('supplier', 'search'));
    
    // Create query string that will be appended to the url
    $query  = http_build_query(array(
                'q' => 'asi:' . $asi_number
              ));
    
    // API query URL
    $api = sprintf('%s?%s', $url, $query);
    
    // Request data from the API.
    $response = file_get_contents( $api );
    
    // Take the response data and convert it to an array.
    $response_decoded = json_decode( $response );
    
    // Since this data will mostly be used for checking existence in asi
    // and importing asi supplier data we will only store this data for 1 minute.
    Cache::put('asi_' . $asi_number, $response_decoded, 2);
    
    // Return the data
    return $response_decoded;
});

/*
|--------------------------------------------------------------------------
| ASI Supplier Search Cache
|--------------------------------------------------------------------------
|
| Search ASI Central's API for supplier(s)
|
*/
IoC::register('asiSupplierSearchCache', function( $asi_number = 0 ){
    
    return Cache::get('asi_' . $asi_number, function() use($asi_number){
        return IoC::resolve('asiSupplierSearch', array($asi_number));
    });
});

/*
|--------------------------------------------------------------------------
| ASI Supplier Record 
|--------------------------------------------------------------------------
|
| Fetch supplier record from  ASI Central's API.
|
*/
IoC::register('asiSupplierRecord', function( $asi_id = 0 ){
    
    // Use laravel controlled url generation (enviornment specific)
    $url    = URL::to_route('asi', array('supplier', 'record'));
    
    // Create query string that will be appended to the url
    $query  = http_build_query(array(
                'id' => $asi_id
              ));
    
    // API query URL
    $api = sprintf('%s?%s', $url, $query);
    
    // Request data from the API.
    $response = file_get_contents( $api );
    
    // Take the response data and convert it to an array.
    $response_decoded = json_decode( $response );
    
    // Save cache of record for 30 days
    Cache::put("asi\suppliers\/" . $asi_id, $response_decoded, (( 60 * 24 ) * 30));
    
    // Return the data
    return $response_decoded;
});

/*
|--------------------------------------------------------------------------
| ASI Supplier Record Cache
|--------------------------------------------------------------------------
|
| Fetch HiProd cache of  ASI Central Supplier Record
|
*/
IoC::register('asiSupplierRecordCache', function( $asi_id = 0 ){
            
    $path = sprintf("asi\suppliers\%d", $asi_id);
    
    return Cache::get($path, function() use($asi_id) {
        
        return IoC::resolve('asiSupplierRecord', array($asi_id));
        
    });
});

/*
|--------------------------------------------------------------------------
| ASI Product Search
|--------------------------------------------------------------------------
|
| Search supplier for products.
|
*/
IoC::register('asiSupplierProductSearch', function( $asi_number = 0, $search_term = false, $page = 1, $rpp = 10 ){
    
    // Use laravel controlled url generation (enviornment specific)
    $url = URL::to_route('asi', array('product', 'search'));
    
    $term = $search_term ? $search_term . ' ' : '';
    
    // Create query string that will be appended to the url
    $query = http_build_query(array(
                'q'     => $term . 'asi:' . $asi_number,
                'page'  => $page,
                'rpp'   => $rpp
              ));
    
    // API query URL
    $api = sprintf('%s?%s', $url, $query);
    
    // Request data from the API.
    $response = file_get_contents( $api );
    
    // Take the response data and convert it to an array.
    $response_decoded = json_decode( $response );
    
    // Return the data
    return $response_decoded;
    
});

/*
|--------------------------------------------------------------------------
| ASI Product Record IMport
|--------------------------------------------------------------------------
|
| Import Product Record
|
*/
IoC::register('asiSupplierProductRecord', function( $id = 0 ){
    
    // Use laravel controlled url generation (enviornment specific)
    $url = URL::to_route('asi', array('product', 'record'));
    
    // Create query string that will be appended to the url
    $query = http_build_query(array(
                'id'     => $id
              ));
    
    // API query URL
    $api = sprintf('%s?%s', $url, $query);
    
    // Request data from the API.
    $response = file_get_contents( $api );
    
    // Take the response data and convert it to an array.
    $response_decoded = json_decode( $response );
        
    // Save cache of record for 30 days
    Cache::put("asi\products\/" . $id, $response_decoded, (( 60 * 24 ) * 30));
    
    // Return the data
    return $response_decoded;
});


/*
|--------------------------------------------------------------------------
| ASI Product Record Import Cache
|--------------------------------------------------------------------------
|
| Fetch ASI product cache from HiProd
|
*/
IoC::register('asiSupplierProductRecordCache', function( $id = 0 ){
    
    $path = sprintf("asi\products\%d", $id);
    
    return Cache::get($path, function() use($id) {
        
        return IoC::resolve('asiSupplierProductRecord', array($id));
        
    });
    
});


IoC::register('asiProductImage', function( $ImageUrl = '' ){
    
    // Set the asi api url
    $asi_url    = Config::get('asi::api.api_url_v1');
    
    // Set the uri path to the image
    $image_uri  = $ImageUrl;
    
    // Return the full link
    return URL::to($asi_url . $image_uri);
});


/* End of file iocs.php */