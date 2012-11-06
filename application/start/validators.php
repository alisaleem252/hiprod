<?php

/*
|--------------------------------------------------------------------------
| Custom Validators
|--------------------------------------------------------------------------
|
| Custom form validation rules.
| @see http://laravel.com/docs/validation
*/
Validator::register('valid_asi', function($attribute, $value, $parameters){
        
    // Query and fetch results from ASI's API
    $response_decoded = IoC::resolve('asiSupplierSearchCache', array($value));
    
    // By default the asi numbers will not match.
    $asi_match = false;
        
    // Loop through all the results, check for a match
    foreach($response_decoded->Results as $result)
    {                
        // Check if AsiNumber in the loop matches the one submitted.
        // If it matches, break from the loop and show match found.
        if( (int) $result->AsiNumber === (int) $value )
        {
            // Update asi match status
            $asi_match = true;
            
            // Break out of the loop
            break;
        }
    }
    
    // Return the response.
    return $asi_match;
});