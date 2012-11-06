<?php
/**
 * ASI Product Controller
 * 
 * @package     Bundles
 * @subpackage  ASI
 * @author      Jordan Dalton <jordandalton@wrsgroup.com>
 *
 * @see http://developers.asicentral.com/console/
 */
class Asi_Product_Controller extends Asi_Base_Controller
{
    //--------------------------------------------------------------------------
    
    /**
     * Search ASI Central.
     */
    public function get_search()
    {                
        // Create new ASI specific rest client instance.
        $restClient = Ioc::resolve('Asi_Rest_Client');
        
        // Query the API and capture the results
        $restGet = $restClient->restGet('v1/products/search.json', Input::query());
        
        // Decode the results and append them to our response.
        $response = Zend_Json::decode($restGet->getBody(), Zend_Json::TYPE_OBJECT); 
        
        // Return the response
        return Response::json( $response );
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Fetch individual product record from ASI Central.
     */
    public function get_record()
    {
        // Create new ASI specific rest client instance.
        $restClient = Ioc::resolve('Asi_Rest_Client');

        // API uri string
        $uriString = sprintf('v1/products/%d.json', (int) Input::query('id', 0));
        
        // Query the API and capture the results
        $restGet = $restClient->restGet( $uriString );
        
        // Decode the results and append them to our response.
        $response = Zend_Json::decode($restGet->getBody(), Zend_Json::TYPE_OBJECT); 
        
        // Return the response
        return Response::json( $response );
    }
    
    //--------------------------------------------------------------------------
}
/* End of file products.php */