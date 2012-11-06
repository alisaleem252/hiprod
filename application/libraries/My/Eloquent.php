<?php
/**
 *  My Eloquent
 *
 *  Extend Laravels Eloquent class.
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Aug 13, 2012, 9:11:03 AM
 */
class MY_Eloquent extends Eloquent
{
    /**
     * Validation Errors
     * 
     * @var array
     */
    private $validation_errors;
        
    /**
     * Validation Messages
     * 
     * @var array
     */
    public $validation_messages = array();
    
    /**
     * Validation Rules
     * 
     * @var array
     */
    public $validation_rules = array();
    
    //--------------------------------------------------------------------------
    
    /**
     * Validate form submission.
     * 
     * @param Input $input
     * @param type $validation_rules 
     */
    public function validate($input, $validation_key)
    {        
        // Check if validation rules do not exist.
        if( !isSet($this->validation_rules[$validation_key]) )
        {
            // Throw exception if they don't
            throw new Exception('Validation rules key \''. $validation_key . '\' is not set.');
        }
        
        // Check form inputs against validation
        $validation = isSet( $this->validation_messages[$validation_key] ) 
                   ? Validator::make(
                       $input, 
                       $this->validation_rules[$validation_key],
                       $this->validation_messages[$validation_key]
                   )
                   : Validator::make(
                       $input, 
                       $this->validation_rules[$validation_key]
                   );
                
        // Check if validation failed.
        if( $validation->fails() )
        {
            // Obtain the validation errors
            $this->validation_errors = $validation->errors;
            
            // Return that validation failed.
            return FALSE;
        }
        
        // Passed validation
        return TRUE;
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Get the $validation_errors
     */
    public function validation_errors()
    {
        return $this->validation_errors;
    }
    
    //--------------------------------------------------------------------------

    /**
     * Escape all HTML prior to inserting/updating database record..
     */
    public function save_escape()
    {
        // Escape all the dirty attributes
        //
        foreach ($this->attributes as $key => $value)
        {
            if ( ! isset($this->original[$key]) or $value !== $this->original[$key])
            {
             	if(!is_null($value))
            	{
                	$this->attributes[$key] = e($value);
                }
            }
        }

        // Call the base classes save.
        parent::save();
    }
    
    //--------------------------------------------------------------------------
}
/* End of file Eloquent.php */