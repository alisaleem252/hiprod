<?php
/**
 *  Admin Ajax Base Controller
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 23, 2012, 9:58:14 AM
 */
class Admin_Base_Ajax_Controller extends Controller
{
	/**
	 * The bundle the controller belongs to.
	 *
	 * @var string
	 */
	public $bundle = 'admin';

	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;
    
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
}
/* End of file base.php */