<?php

/**
 *  base
 *
 *  Description goes here..
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 23, 2012, 9:58:14 AM
 */
class Admin_Base_Controller extends Controller
{
	/**
	 * The bundle the controller belongs to.
	 *
	 * @var string
	 */
	public $bundle = 'admin';

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
    
    /**
     * Employees that have ultimate admin rights through the application.
     * 
     * @var array
     */
    public $globalAdmins = array(
        'jdalton'
    );
    
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
    
	/**
	 * Create a new Controller instance.
	 *
	 * @return void
	 */
    public function __construct()
    {
        // Use ldap authentication throughout the admin sections
        Config::set('auth.driver', 'ldapauth');
        
        // Override the layout
        $this->layout = "{$this->bundle}::{$this->layout}";
        
		parent::__construct();
    }
}
/* End of file base.php */
