<?php
/**
 *  Vendor Data Model
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 24, 2012, 3:20:46 PM
 */
class Vendor extends MY_Eloquent
{   
    //--------------------------------------------------------------------------    
    
    /**
     * Relate Vendor to Product
     */
    public function products()
    {
        // A vendor can have many products
        return $this->has_many('Product');
    }
    
    //--------------------------------------------------------------------------

    /**
     * Relate vendor to user (client) account.
     */
    public function user()
    {        
        // A vendor can only belong to one user (client) account.
        return $this->belongs_to('User', 'id');
    }
    
    //--------------------------------------------------------------------------
}
/* End of file vendor.php */