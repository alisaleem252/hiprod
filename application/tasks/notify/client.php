<?php
/**
 *  Client Notificatino Tasks
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Nov 2, 2012, 10:14:58 AM
 */
class Notify_Client_Task
{   
    //--------------------------------------------------------------------------
    
    /**
     * Run
     */
    public function run(){}
    
    //--------------------------------------------------------------------------

    /**
     * Notify user of their new account.
     * 
     * @param array   $data             The data to be sent to the user.
     * @param boolean $adminGenerated   Account is being created via the admin panel.
     */
    public function accountCreation( $data = array(), $viaAdmin = false )
    {

    }
    
    //--------------------------------------------------------------------------

    /**
     * Notify user that their password has been reset.
     * 
     * @param string|int  $id       The user's id number.
     * @param bool        $viaAdmin Password is being reset via the admin panel.
     */
    public function resetPassword( $id = 0, $viaAdmin = false )
    {
        // Fetch the user's account
        $user = User::find($id);
        
        // Proceed if user account exists
        if( isSet($user->exists) )
        {
            // Capture the users email address.
            $email_address = $user->email;
            
            // Set the new password.
            $newPassword = $this->rand_string(10);
            
            // Set the new password for the user record
            $user->password = $newPassword;
            
            // Update the user record.
            $user->save();
            
            // Load our default admin email notification settings.
            $mail = IoC::resolve('adminEmailNotification');
            
            // The email address the email will be sent to.
            $mail->addTo($email_address);

            // The title of the email.
            $mail->setSubject("You're HiProd password has been reset.");
            
            // The content body of the email.
            $mail->setBodyText(
                $viaAdmin 
                    ? "You're password has been reset by the HiProd administrator.\n\nNew Password: " . $newPassword
                    : "You're HiProd account password has been reset to the following: " . $newPassword
            );
            
            // Return response.
            return ( !$mail->send() ) ? FALSE : TRUE;
        }
        
        return FALSE;
    }
    
    //--------------------------------------------------------------------------

    /**
     * Generate random string of characters.
     * 
     * @param string|int $length    The out string length (in characters).
     * @return string
     */
    private function rand_string( $length = 5 )
    {
        // The the list of allowable characters to use.
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

        // Create a general string.
        $str = '';
        
        // How many available $chars characters are available?
        $size = strlen( $chars );
        
        // Start looping..
        for( $i = 0; $i < $length; $i++ )
        {
            // Randomly generate a character the defined $char list and append
            // it to the current $str value.
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        // Return the string
        return $str;
    }
    
    //--------------------------------------------------------------------------
}

/* End of file client.php */