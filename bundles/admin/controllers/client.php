<?php
/**
 *  clients
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Nov 2, 2012, 8:16:15 AM
 */
class Admin_Client_Controller extends Admin_Base_Controller
{
    //--------------------------------------------------------------------------

    /**
     * Allow administrator to login to client account as the client.
     */
    public function get_forced_login( $id )
    {
        // Log the administrator into the client's account.
        Auth::driver('eloquent')->login( $id );
        
        // Redirect admin to the client dashboard.
        return Redirect::to_route('client-dashboard');
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Clients Startpage (Paginated)
     */
    public function get_index()
    {   
        // How many clients do you want to appear on each page?
        $items_per_page = 10;

        // Fetch clients from the database.
        $clients = Input::query('criteria') 
                    ? User::join('vendors', 'users.vendor_id', '=', 'vendors.id')
                          ->where('users.email', 'like', '%' . Input::query('criteria') .'%')
                          ->or_where('vendors.name', 'like', '%' . Input::query('criteria') .'%')
                          ->order_by('users.id')
                          ->paginate( $items_per_page )
                    : User::with('vendor')
                          ->order_by('id')
                          ->paginate( $items_per_page );

        // If a search was performed we will need to carry the search term
        // along the query string during paginated results. 
        if( Input::query('criteria') ){
            $clients->appends(array('criteria' => Input::query('criteria')));
        }
        
        // Render the page.
        View::make($this->bundle . '::client.index')->with('clients', $clients)->render();
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Add new client account.
     */
    public function get_add()
    {
        // Render the page
        View::make($this->bundle . '::client.add')->render();
    }
    
    //--------------------------------------------------------------------------

    /**
     * Add new client account (postback)
     */
    public function post_add()
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
            return Redirect::to_route('admin-clients');
        }
        
        /*
         * Inputs failed validation.
         *  - Return user to the login page.
         *  - Populate all form fields with the previously submitted data.
         */
        else return Redirect::to_route('admin-clients-add')->with_errors($user->validation_errors())->with_input();
    }
    
    //--------------------------------------------------------------------------

    /**
     * Edit Client Acount
     */
    public function get_edit( $id )
    {
        // Fetch the user record
        $client = User::find($id);
       
        // Render the page
        View::make($this->bundle . '::client.edit')->with('client', $client)->render();
    }
    
    //--------------------------------------------------------------------------

    /**
     * Edit Client Account (Postback)
     */
    public function post_edit( $id )
    {
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
            return Redirect::to_route('admin-clients');
        }
        
        /*
         * Inputs failed validation.
         *  - Return user to the page.
         *  - Populate all form fields with the previously submitted data.
         */
        else return Redirect::to_route('admin-clients-edit', array($id))->with_errors($validated->errors)->with_input();
    }
    
    //--------------------------------------------------------------------------
}
/* End of file client.php */