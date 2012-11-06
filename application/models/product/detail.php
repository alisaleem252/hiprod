<?php
/**
 *  Product Detail Data Model
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 30, 2012, 2:31:33 PM
 */
class Product_Detail extends MY_Eloquent
{
    //--------------------------------------------------------------------------
    
	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'products_details';
    
    //--------------------------------------------------------------------------
    
    /**
     * Relate Product Detail to Product
     */
    public function product()
    {
        return $this->belongs_to('Product');
    }
}
/* End of file detail.php */