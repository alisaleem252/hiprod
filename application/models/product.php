<?php
/**
 *  Product Data Model
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 29, 2012, 3:26:17 PM
 */
class Product extends MY_Eloquent
{
    //--------------------------------------------------------------------------
    
    /**
     * Relate Product to Vendor
     */
    public function vendor()
    {
        // A product can only belong to one vendor
        return $this->belongs_to('Vendor');
    }
    
    //--------------------------------------------------------------------------

    /**
     * Relate Product to Product_Detail
     */
    public function product_detail()
    {
        return $this->has_one('Product_Detail');
    }
    
    //--------------------------------------------------------------------------
}
/* End of file product.php */