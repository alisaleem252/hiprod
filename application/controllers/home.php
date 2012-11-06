<?php

class Home_Controller extends Base_Controller
{
    //--------------------------------------------------------------------------
    
    /**
     * Application Startpage
     */
	public function get_index()
	{        
        // Redirect to login page.
        return Redirect::to_route('client-dashboard');
	}

    //--------------------------------------------------------------------------

    /**
     * Client registration page.
     */
    public function get_register()
    {        
        // Render the page
        View::make('home.register')->render();
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Client registration registration (POSTBACK)
     */
    public function post_register()
    {       
        // Create instance of User
        $user = new User;
        
        // Check inputs against form validation.
        $validated = $user->validate( Input::all(), 'create_client');
        
        // Input passed validation.
        if( $validated )
        {           
            // Query for vendor record
            $vendor = Vendor::where_asi_number( Input::get('asi_number') )->first();
            
            // By default set the vendor id to 0 (false)
            $vendor_id = false;
            
            // Vendor record exists
            if( isSet($vendor->exists) )
            {
                // Override $vendor_id with id value from the db.
                $vendor_id = $vendor->id;
            }
            
            // Vendor record does not currently exist...so create one
            else
            {                
                // Fetch ASI record and cache it
                $insert = IoC::resolve('asiSupplierSearchCache', array( Input::get('asi_number') ) );

                // Create vendor record
                $vendor_id = Vendor::create(array(
                                'asi_id'    => $insert->Results[0]->Id,
                                'asi_number'=> $insert->Results[0]->AsiNumber,
                                'name'      => $insert->Results[0]->Name,
                            ))->id;
            }
            
            // Relate user to a vendor record
            $user->vendor_id = $vendor_id;
            
            // Populate columns with matching input fields.
            $user->fill( Input::all() );
            
            // Save new user record
            $user->save();
            
            // Redirect to the login page.
            return Redirect::to_route('client-login');
        }
        
        /*
         * Inputs failed validation.
         *  - Return user to the login page.
         *  - Populate all form fields with the previously submitted data.
         */
        else return Redirect::to_route('client-register')->with_errors($user->validation_errors())->with_input();
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * User Login Page
     */
    public function get_login()
    {
        // Render the page.
        View::make('home.login')->render();
    }

    //--------------------------------------------------------------------------
    
    /**
     * User Login Page (POSTBACK)
     */
    public function post_login()
    {
        // Create new instance of User
        $user = new User;
                
        // Check if form inputs pass validaton.
        if( $user->validate(Input::all(), 'login_client') )
        {            
            // Attempt to validate ldap user credentials
            try { Auth::attempt( Input::all() ); }

            // Exception handling
            catch ( Exception $exc )
            {                        
                // Failed authentication...send back to the login
                return Redirect::to_route('client-login')->with('login_errors', true)->with_input();  
            }
                        
            // Check if we need to redirect user to a previously requested page
            if( Session::has('pre_login_url') )
            {
                // Fetch and assign the url from the session.
                $url = Session::get('pre_login_url');   

                // Remove the pre_login_url form the session data.
                Session::forget('pre_login_url');

                // Redirect user
                return Redirect::to( $url );
            }
            
            // If login is valid then redirect to the dashboard.
            return Redirect::to_route('client-dashboard');
        }
        
        // Validation failed
        else
        {
            // Return the user to the form, along with errors and original input.
            return Redirect::to_route('client-login')->with_errors($user->validation_errors())->with_input();
        }
    }
    
    //--------------------------------------------------------------------------

    /**
     * Log the client out of their session.
     */
    public function get_logout()
    {
        // See if the user was originally logged in as an administrator.
        $redirect_to_admin = isSet( Session::instance()->session['data']['ldapauth_ldapauth_login'] );
        
        // Log user out of their session
        Auth::logout();
        
        // Redirect to application startpage
        return Redirect::to_route($redirect_to_admin ? 'admin-login' : 'client-login');
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Update client accoutn information.
     */
    public function get_account()
    {
        // Fetch the users id number from their session.
        $id = Auth::user()->id;
        
        // Fetch the user record
        $client = User::find( $id );
       
        // Render the page
        View::make('home.account')->with('client', $client)->render();
    }
    
    //--------------------------------------------------------------------------
    /**
     * Update client accoutn information. (POSTBACK)
     */    
    public function post_account()
    {
        // Fetch the users id number from their session.
        $id = Auth::user()->id;
        
        // Fetch the old user record.
        $old = User::find( $id );
        
        // Create instnce of user
        $u = new User();
        
        // Check it password was submitted
        $password_submitted = (bool) trim( Input::get('password') );
        
        // If password was not subbmited, disregard validation rule.
        if ( !$password_submitted ){
            
            // Remove it from the postback data
            Request::foundation()->request->remove('password');
            
            // Remove form validation rules
            array_forget($u->validation_rules['update_client'], 'password');
        }
                
        // Loop through the submitted data.
        foreach( Input::all() as $key => $value)
        {
            if( $old->$key != Input::get($key)){
                
            } else {
                array_forget($u->validation_rules['update_client'], $key);
            }
        }
        
        // Check inputs against form validation.
        $validated = Validator::make(
                        Input::all(), 
                        $u->validation_rules['update_client'],
                        $u->validation_messages['update_client']
                     );
               
        // Input passed validation.
        if( !$validated->fails() )
        {  
            // Update the user account.
            User::find($id)->fill( Input::all() )->save();
            
            // Redirect to the login page.
            return Redirect::to_route('client-dashboard');
        }
        
        /*
         * Inputs failed validation.
         *  - Return user to the page.
         *  - Populate all form fields with the previously submitted data.
         */
        else return Redirect::to_route('client-account', array($id))->with_errors($validated->errors)->with_input();   
    }
    
    //--------------------------------------------------------------------------

    /**
     * Client Dashboard
     */
    public function get_dashboard()
    {        
        // Render the page.
        View::make('home.dashboard')->render();
    }
    
    //--------------------------------------------------------------------------
}