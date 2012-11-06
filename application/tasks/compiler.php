<?php

/**
 *  compiler
 *
 *  Description goes here..
 *
 *  @author Jordan Dalton <jordandalton@wrsgroup.com>
 *  @created Nov 6, 2012, 10:05:50 AM
 */
class Compiler_Task
{
    //--------------------------------------------------------------------------
    
    /**
     * Execute Compiler
     */
    public function run()
    {
        set_time_limit(0);
        
        // The folder path to the closure folder
        $compiler_folder  = path('app') . 'closure-compiler';
        
        // The commaand format to execute closure compiler
        $compiler_command = 'cd ' . $compiler_folder . ' && java -jar compiler.jar --js %s --js_output_file %s';
                
        // Set which directories we will apply the compiler to
        $glob_loops = array(
            
            // Public js folder
            path('public') . 'js' . DS . '{*.js}',
            
            // Any pulic js Subfolder
            path('public') . 'js' . DS . '*\{*.js}',
            
            // Admin bundle js folder
            path('public') . 'bundles\admin\js\{*.js}',
            
            // Admin bundle js subfolder
            path('public') . 'bundles\admin\js\*\{*.js}',
            
        );
        
        // Start looping through each supplied directory
        foreach($glob_loops as $glob_loop)
        {
            // Loop through all the files inside eachfolder
            foreach(glob($glob_loop, GLOB_BRACE) as $file)
            {                
                // If a compiled file...then remove id
                if( preg_match('/((.*)-compiled.(.*))/', $file) )
                {
                    // Remove the file
                    File::delete($file);
                    
                    // Skip once
                    continue;
                }
                
                /* Get the path information for the file. */
                $path = pathinfo($file);

                // Target File
                $target_file    = $path['dirname'] . DS . $path['filename'] . '.' . $path['extension'];
                
                // Destination (compiled) file.
                $compiled_file  = $path['dirname'] . DS . $path['filename'] . '-compiled.' . $path['extension'];

                // Prepare the command
                $cmd = sprintf($compiler_command, $target_file, $compiled_file);
                
                // Execute the command
                exec($cmd);
                /**/
                //var_dump($image);
            }   
        }
    }
    
    //--------------------------------------------------------------------------
}
/* End of file compiler.php */