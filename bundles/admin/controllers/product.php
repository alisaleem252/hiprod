<?php

/**
 *  products
 *
 *  Description goes here..
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 24, 2012, 12:10:51 PM
 */
class Admin_Product_Controller extends Admin_Base_Controller
{
    //--------------------------------------------------------------------------

    /**
     * Product Startpage (Paginated)
     */
    public function get_index()
    {                 
        // How many products do you want to appear on each page?
        $items_per_page = 10;
        
        // Fetch the input name
        $input = Input::query('name');

        // Query the database for records
        $products = Product::with('vendor')->where(function($query) use($items_per_page, $input){

            // By default no asi_number is specified
            $asi_number = false;
            
            // Check if user submitted a specific asi number
            $asi_query = preg_match('/(asi_number:(\d+))/', $input, $result);
            
            // User specified a specific asi number
            if( $asi_query )
            {
                // Capture only the asi number
                $asi_number = trim(preg_replace('/(asi_number:)(\d+)/', '$2', $result[0]));
                
                // Remove the asi reference from the input string
                $input = trim(preg_replace('/(asi_number:(\d+))/', '', $input));
            }
                            
            //$query->where('name', 'like', '%' . $input . '%');
            $query->where('name', 'like', '%' . $input. '%');
            
            // ASI Number was specified
            if($asi_number){
                
                // Search for vendore record
                $vendor_fetch = Vendor::where_asi_number($asi_number)->first();
                                
                $query->where('vendor_id', '=', is_null($vendor_fetch) ? 0 : $vendor_fetch->id);                
            }
            
        })->paginate($items_per_page);
        
        // If a search was performed we will need to carry the search term
        // along the query string during paginated results. 
        if( Input::query('name') ){
            $products->appends(array('name' => $input));
        }
        
        // Render the page.
        View::make($this->bundle . '::product.index')->with('products', $products)->render();
    }
    
    //--------------------------------------------------------------------------

    /**
     * Add/Import product form ASI
     */
    public function get_add()
    {        
        // Render the page
        View::make($this->bundle . '::product.add')->render();
    }
    
    //--------------------------------------------------------------------------

    /**
     * Edit Product Record
     * 
     * @param string|int $id    The HiProd product id number
     */
    public function get_edit( $id )
    {
        // Query for the product record.
        $product = Product::with(array('Vendor', 'Product_Detail'))->find($id);
        
        // Return 404 (page not found) if the record does not exist.
        if ( !isSet( $product->exists ) ) return Response::error (404);
        
        // Fetch the cache record of the product form ASI.
        $cache = IoC::resolve('asiSupplierProductRecordCache', array($product->asi_id));
        
        // Fetch the vendor cache record from ASI
        $vendor = IoC::resolve('asiSupplierRecordCache', array($product->Vendor->asi_id));

        // Fetch the product details
        $details = $product->Product_Detail;
        
        // Render the page
        View::make($this->bundle . '::product.edit')
            ->with('product', $product)
            ->with('details', $details)
            ->with('cache', $cache)
            ->with('vendor', $vendor)
            ->render();
    }
    
    //--------------------------------------------------------------------------

    /**
     * Edit Product Record (Postback)
     * 
     * @param string|int $id    The HiProd product id number
     */
    public function post_edit( $id )
    {
        // Fetch the product record
        $product = Product::find( $id );       
        
        // Record Exists
        if( isSet($product->exists) )
        {
            // Loop through all of the submitted data
            foreach( Input::all() as $key => $value){
                
                // Determine if input was empty
                $val = (bool) trim($value);
                
                // If empty value..replace with N/A
                if(!$val)   Input::replace(array($key => 'N/A'));
            }
            
            // Update db fields with escaped data.
            $product->product_detail->fill( Input::all() )->save_escape();
            
            // Redirect the user
            return Redirect::to_route('admin-products');
        }
        
        // Otherwise throw 404 error
        else return Response::error(404);
    }
    
    //--------------------------------------------------------------------------

    /**
     * View Product Record
     * 
     * @param string|int $id    The HiProd product id number.
     */
    public function get_view( $id )
    {               
        // Query for the product record.
        $product = Product::with(array('Vendor', 'Product_Detail'))->find($id);
        
        // Return 404 (page not found) if the record does not exist.
        if ( !isSet( $product->exists ) ) return Response::error (404);
        
        // Fetch the cache record of the product form ASI.
        $cache = IoC::resolve('asiSupplierProductRecordCache', array($product->asi_id));
        
        // Fetch the vendor cache record from ASI
        $vendor = IoC::resolve('asiSupplierRecordCache', array($product->Vendor->asi_id));

        // Fetch the product details
        $details = $product->Product_Detail;
        
        // Render the page
        View::make($this->bundle . '::product.view')
            ->with('product', $product)
            ->with('details', $details)
            ->with('cache', $cache)
            ->with('vendor', $vendor)
            ->render();
    }
    
    //--------------------------------------------------------------------------
}
/* End of file products.php */