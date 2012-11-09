<?php
/**
 * Main Admin Controller
 */
class Admin_Home_Controller extends Admin_Base_Controller
{
    //--------------------------------------------------------------------------
    
    /**
     * Admin Startpage
     * 
     * @return mixed
     */
    public function get_index()
    {        
        // If user is already logged in, redirect to dashboard.
        if ( Auth::user() )
        {
            // Check if we need to redirect user to a previously requested page
            if( Session::has('pre_login_url') )
            {
                // Fetch and assign the url from the session.
                $url = Session::get('pre_login_url');   

                // Remove the pre_login_url form the session data.
                Session::forget('pre_login_url');

                // Redirect user the url they were trying to access
                return Redirect::to( $url );
            }
            // Redirect to the admin dashboard otherwise
            return Redirect::to_route('admin-dashboard');
        }
        // Redirect to login page otherwise
        return Redirect::to_route('admin-login');
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Admin Login Page
     * 
     * @return mixed
     */
    public function get_login()
    {
        // If user is already logged in, redirect to dashboard.
        if ( Auth::user() ) return Redirect::to_route('admin-dashboard');

        // Render the page
        View::make($this->bundle . '::home.login')->render();
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Admin Login Postback
     * 
     * @return mixed
     */
    public function post_login()
    {        
        // Create new instance of User
        $user = new User;
                
        // Check if form inputs pass validaton.
        if( $user->validate(Input::all(), 'login_employee') )
        {
            // Attempt to validate ldap user credentials
            try { Auth::driver('ldapauth')->attempt( Input::all() ); }

            // Exception handling
            catch ( Exception $exc )
            {
                // Failed authentication...send back to the login
                return Redirect::to_route('admin-login')->with('login_errors', true)->with_input();  
            }
            
            // Prepare our data for the session (and potential new user record).
            $data = array(
                'firstname' => Auth::user()->firstname,
                'lastname'  => Auth::user()->lastname,
                'name'      => Auth::user()->name,
                'email'     => Auth::user()->email,
                'username'  => Auth::user()->username
            );
            
            // Loop through our data and place it in the sessions.
            foreach($data as $key => $value )
            {
                // Place the data in the session.
                Session::put($key, $value);   
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
            return Redirect::to_route('admin-dashboard');
        }
        
        // Validation failed
        else
        {
            // Return the user to the form, along with errors and original input.
            return Redirect::to_route('admin-login')->with_errors($user->validation_errors())->with_input();
        }
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Log the employee out of their session.
     */
    public function get_logout()
    {       
        // Log user out of their session
        Auth::logout();
        
        // Redirect to application startpage
        return Redirect::to_route('admin-login');
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Admin Dashboard
     * 
     * @return mixed
     */
    public function get_dashboard()
    {        
        // Render the page
        View::make($this->bundle . '::home.dashboard')->render();
    }
    
    //--------------------------------------------------------------------------
}

/* End of file home.php */