<?php
/**
 *  Ajax Controller
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Nov 1, 2012, 9:39:54 AM
 */
class Ajax_Controller extends Base_Ajax_Controller
{
    //--------------------------------------------------------------------------
    
    /**
     * Check to see if particular ASI number is valid within ASI Central.
     * 
     * @param string|int $asi_number    The asi number to check against.
     */
    public function get_asi_quickcheck( $asi_number )
    {
		$input = array('asi_number' => $asi_number);
		$rules = array('asi_number' => 'valid_asi');
        
        // Create resposne object
        $response = new stdClass();
        
        // Validate if the provided asi # is existent within ASI Central.
        $response->valid = (int) Validator::make($input, $rules)->valid();
        
        // Return the response
        return Response::json( $response );
    }
    //--------------------------------------------------------------------------    
}
/* End of file ajax.php */