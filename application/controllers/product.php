<?php
/**
 *  Product Controller
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Nov 5, 2012, 9:27:01 AM
 */
class Product_Controller extends Base_Controller
{
    public function get_index()
    {
        // How many products do you want to appear on each page?
        $items_per_page = 10;
        
        // Fetch all products from the database.
        $products = Input::query('name') 
                    ? Product::with('vendor')
                             ->where('name', 'like', '%' . Input::query('name') . '%')
                             ->where_vendor_id( Auth::user()->vendor_id )
                             ->order_by('id')
                             ->paginate( $items_per_page ) 
                    : Product::with('vendor')
                             ->where_vendor_id( Auth::user()->vendor_id )
                             ->order_by('id')
                             ->paginate( $items_per_page );
        
        // If a search was performed we will need to carry the search term
        // along the query string during paginated results. 
        if( Input::query('name') ){
            $products->appends(array('name' => Input::query('name')));
        }
        
        // Render the page.
        View::make('product.index')->with('products', $products)->render();
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
        $product = Product::with(array('Vendor', 'Product_Detail'))
                          ->where_id( $id )
                          ->where_vendor_id( Auth::user()->vendor_id )
                          ->first();
        
        // Return 404 (page not found) if the record does not exist.
        if ( !isSet( $product->exists ) ) return Response::error (404);
        
        // Fetch the cache record of the product form ASI.
        $cache = IoC::resolve('asiSupplierProductRecordCache', array($product->asi_id));
        
        // Fetch the vendor cache record from ASI
        $vendor = IoC::resolve('asiSupplierRecordCache', array($product->Vendor->asi_id));

        // Fetch the product details
        $details = $product->Product_Detail;
        
        // Render the page
        View::make('product.edit')
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
            return Redirect::to_route('client-products');
        }
        
        // Otherwise throw 404 error
        else return Response::error(404);
    }
    
    //--------------------------------------------------------------------------
}
/* End of file product.php */