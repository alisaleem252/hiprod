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
                    ? 'mail.wrsgroup.com' 
                    : 'mail.wrsgroup.com',

	/*
	|--------------------------------------------------------------------------
	| Default From
	|--------------------------------------------------------------------------
	|
	| Default "from" address for all outbound emails.
	|
	*/
    'from' => defined('LARAVEL_ENV') === 'production' 
                    ? 'jordandalton@wrsgroup.com' 
                    : 'jordandalton@wrsgroup.com',
    
	/*
	|--------------------------------------------------------------------------
	| Default Admin Email Address
	|--------------------------------------------------------------------------
	*/
    'admin' => defined('LARAVEL_ENV') === 'production' 
                    ? 'jordandalton@wrsgroup.com' 
                    : 'jordandalton@wrsgroup.com',
);

/* End of file email.php */