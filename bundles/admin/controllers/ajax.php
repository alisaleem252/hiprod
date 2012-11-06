<?php

class Admin_Ajax_Controller extends Admin_Base_Ajax_Controller
{
    //--------------------------------------------------------------------------
    
    public function get_index()
    {
        // Prepare response object
        $response = new stdClass();
        $response->message = 'Hell World';
        
        // Return the response
        return Response::json($response);
    }
    
    //--------------------------------------------------------------------------

    /**
     * Import vendor from ASI. 
     */
    public function post_import_vendors()
    {
        // Capture the input/postback data
        $data = Input::get('data');
        
        // Any vendors that already exist in HiProd will be adde to this list.
        $exclude = array();
        
        // Check if vendors already exist in hiprod
        $existing = Vendor::where_in('asi_number', array_keys($data))->get('asi_number');
        
        // If exisitng records are present.
        foreach ( $existing as $existing_record )
        {
            $exclude[] = $existing_record->asi_number;
        }
        
        // Records to be inserted
        $toInsert = array_except($data, $exclude);
            
        // Inserted record counter
        $insertCount = 0;
        
        // Loop through the records to be inserted
        foreach($toInsert as $insert)
        {
            // Fetch ASI record and cache it
            IoC::resolve('asiSupplierRecord', array($insert['id']));
            
            // Create vendor record
            Vendor::create(array(
                'asi_id'    => $insert['id'],
                'asi_number'=> $insert['number'],
                'name'      => $insert['name']
            ));
            
            // Increment the counter.
            $insertCount++;
        }
        
        // Return the repsonse
        return Response::json( $insertCount );
    }
    
    //--------------------------------------------------------------------------

    /**
     * Import products from ASI Central.
     */
    public function post_import_products()
    {
        // Capture the input/postback data
        $data = Input::get('data');
        
        // Any vendors that already exist in HiProd will be adde to this list.
        $exclude = array();
        
        // Check if vendors already exist in hiprod
        $existing = Product::where_in('asi_id', array_keys($data))->get('asi_id');
        
        // If exisitng records are present.
        foreach ( $existing as $existing_record )
        {
            $exclude[] = $existing_record->asi_id;
        }

        // Records to be inserted
        $toInsert = array_except($data, $exclude);
                
        // Inserted record counter
        $insertCount = 0;
        
        // Loop through the records to be inserted
        foreach($toInsert as $insert)
        {
            // Fetch ASI record and cache it
            IoC::resolve('asiSupplierProductRecord', array($insert['id']));
            
            // Create product record
            $createProduct = Product::create(array(
                'asi_id'        => $insert['id'],
                'name'          => $insert['name'],
                'description'   => $insert['description'],
                'vendor_id'     => Vendor::where_asi_id($insert['supplier_id'])->first()->id
            ));
            
            // Create associated product detail record.
            Product_Detail::create(array(
                'product_id' => $createProduct->id
            ));
            
            // Increment the counter.
            $insertCount++;
        }
        
        // Return the repsonse
        return Response::json( $insertCount );
    }
    
    //--------------------------------------------------------------------------

    /**
     * Search ASI products by vendor id.
     */
    public function post_asi_product_search()
    {
        // Set the ASI Number
        $asi_number = preg_replace('/.*\sasi\:(\d+)/', '$1', Input::get('q', 'asi:0'));
        
        // Set the search term
        $searchTerm = preg_replace('/(asi\:\d+)/', '', Input::get('q', false));
        
        // Set what page of results to be shown
        $page = Input::get('page', 1);
        
        // Set how many results should be shown per page.
        $rpp = Input::get('rpp', 40);
        
        // Fetch the results from the ASI Central API
        $response = IoC::resolve('asiSupplierProductSearch', array($asi_number, $searchTerm, $page, $rpp));
        
        // Render the view
        return View::make('admin::ajax.asi.product-search')->with('response', $response);
    }
    
    //--------------------------------------------------------------------------
}
/* End of file ajax.php */