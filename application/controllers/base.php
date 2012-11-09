<?php

class Base_Controller extends Controller
{
    //--------------------------------------------------------------------------
    
	/**
	 * The layout being used by the controller.
	 *
	 * @var string
	 */
	public $layout = 'layouts.default';
    
	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;
    
    //--------------------------------------------------------------------------
    
	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}
    
    //--------------------------------------------------------------------------
    
	/**
	 * Create a new Controller instance.
	 *
	 * @return void
	 */
    public function __construct()
    {
        // Use ldap authentication throughout the admin sections
        Config::set('auth.driver', 'eloquent');
                
        // Share the sidebar anywhere
        View::share('sidebar', View::make('partials.sidebar')->render());
   
		parent::__construct();
    }
}