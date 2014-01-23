<?php

return array(
    
	/*
	|--------------------------------------------------------------------------
	| Mail Server
	|--------------------------------------------------------------------------
	|
	| The address of the email server
	|
	*/
    'server' => defined('LARAVEL_ENV') === 'production' 
                    ? '<production mail server address>' 
                    : '<development server address>',

	/*
	|--------------------------------------------------------------------------
	| Default From
	|--------------------------------------------------------------------------
	|
	| Default "from" address for all outbound emails.
	|
	*/
    'from' => defined('LARAVEL_ENV') === 'production' 
                    ? '<production email address>' 
                    : '<development email address>',
    
	/*
	|--------------------------------------------------------------------------
	| Default Admin Email Address
	|--------------------------------------------------------------------------
	*/
    'admin' => defined('LARAVEL_ENV') === 'production' 
                    ? '<production email address>' 
                    : '<development email address>',
);

/* End of file email.php */