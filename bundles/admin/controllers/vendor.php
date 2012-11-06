<?php
/**
 *  Vendor Controller
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 24, 2012, 3:13:48 PM
 */
class Admin_Vendor_Controller extends Admin_Base_Controller
{
    //--------------------------------------------------------------------------
    
    /**
     * Vendor Startpage (Paginated)
     */
    public function get_index()
    {   
        // How many products do you want to appear on each page?
        $items_per_page = 10;
        
        // Fetch all vendors from the database.
        $vendors = Input::query('name') 
                 ? Vendor::where('name', 'like', '%' . Input::query('name') . '%')->order_by('id')->paginate( $items_per_page ) 
                 : Vendor::order_by('id')->paginate( $items_per_page );
        
        // If a search was performed we will need to carry the search term
        // along the query string during paginated results. 
        if( Input::query('name') ){
            $vendors->appends(array('name' => Input::query('name')));
        }
        
        // Render the page.
        View::make($this->bundle . '::vendor.index')->with('vendors', $vendors)->render();
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Vendor Search Page
     */
    public function get_add()
    {        
        // Render the page.
        View::make($this->bundle . '::vendor.add')->render();
    }
    
    //--------------------------------------------------------------------------
}
/* End of file vendor.php */