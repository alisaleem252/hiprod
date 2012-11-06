<?php

/**
 *  Helper
 *
 *  Description goes here..
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Oct 16, 2012, 10:34:52 AM
 */
class My_Helper
{
    public static function toArray( $data )
    {
        if( is_array($data) || is_object($data) )
        {
            $result = array(); 
            foreach ($data as $key => $value)
            { 
                $result[$key] = self::toArray($value); 
            }
            return $result;
        }
        return $data;
    }  
    
    /**
     * Return if employee has admin privileges.
     * 
     * @return boolean
     */
    public static function isPrivilegedEmployee()
    {
        return IoC::resolve('isPrivilegedEmployee');
    }
    
    /**
     * Return if employee has admin privileges.
     * 
     * @return boolean
     */
    public static function isAdmin()
    {
        $globalAdmins = array(
            'jdalton',
            'blivings'
        );
        
        return in_array(Session::get('username'), $globalAdmins);
    }
}
/* End of file Helper.php */