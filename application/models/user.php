<?php

/**
 *  User Model
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 23, 2012, 4:47:25 PM
 */
class User extends My_Eloquent
{
    //--------------------------------------------------------------------------
    //public static $hidden = array('email', 'password', 'name');
    
    /**
     * Validation Rules
     * 
     * @var array
     */
    public $validation_rules = array(
        //--------------------------
        // Create User
        //--------------------------
        'create_client' => array(
            'asi_number'=> 'required|numeric|valid_asi|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|alpha_dash|min:4',
            'username'  => 'required|alpha_dash|unique:users'
        ),
        //--------------------------
        // Update User
        //--------------------------
        'update_client'     => array(
            'asi_number'=> 'required|numeric|valid_asi|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|alpha_dash|min:4',
            'username'  => 'required|alpha_dash|unique:users'
        ),
        //--------------------------
        // Login User
        //--------------------------
        'login_client' => array(
            'username'  => 'required|alpha_dash|exists:users',
            'password'  => 'required|alpha_dash'
        ),
        'login_employee' => array(
            'username'  => 'required|alpha_dash',
            'password'  => 'required|alpha_dash'
        ),
    );
    
    /**
     * Validation Messages
     * 
     * @var array
     */
    public $validation_messages = array(
        // Create User
        //--------------------------
        'create_client' => array(
            'asi_number_unique' => 'Sorry, that :attribute is already assigned to a client account.',
        ),
        // Update User
        //--------------------------
        'update_client' => array(
            'asi_number_unique' => 'Sorry, that :attribute is already assigned to a client account.',
        ),
        // Login User
        //--------------------------
        'login_client'    => array(
            'username_exists' => 'Sorry, that :attribute does not exist in our system.',
        ),
    );
    
    //--------------------------------------------------------------------------

    /**
     * Automatically hash password field.
     */
    public function set_password( $password )
    {
        $this->set_attribute('password', Hash::make($password));
    }
    
    //--------------------------------------------------------------------------

    /**
     * Relate user to vendor account.
     */
    public function vendor()
    {        
        // User can only have one vendor account.
        return $this->has_one('Vendor', 'id');
    }
    
    //--------------------------------------------------------------------------
}
/* End of file user.php */