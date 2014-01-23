<?php

return array(
    
	/*
	|--------------------------------------------------------------------------
	| ASI Api Credentials
	|--------------------------------------------------------------------------
	|
    | In order to make authorized calls to ASI's APIs, you must register an 
    | application with ASI. Once you have an application id and secret, follow 
    | the steps described for Authorizing a request. 
	|
	| @see http://developers.asicentral.com/docs/auth/
	|
	*/
    
    'api_key'       => '<api key>',
    'api_secret'    => '<api secret>',
    'api_url'       => 'http://api.asicentral.com',
    'api_url_v1'    => 'http://api.asicentral.com/v1/',
    
	/*
	|--------------------------------------------------------------------------
	| Rest Client Default Configuration
	|--------------------------------------------------------------------------
	|
    | Specify default configuration for Zend_Rest_Client during instantiation;
	|
	*/
    'client_configs' => array(
        'timeout' => 30
    ),
);

/* End of file api.php */