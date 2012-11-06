<?php

/**
 *  Admin User Model
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 24, 2012, 8:09:41 AM
 */
class User_Admin extends Eloquent
{
    //--------------------------------------------------------------------------
    
    public static $hidden = array('id', 'created_at', 'updated_at');
    
	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'users_admins';
    
    //--------------------------------------------------------------------------
}
/* End of file admin.php */