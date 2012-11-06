<?php

/**
 * Set the page title, e.g., <title>About Us</title>.
 */
HTML::macro('page_title', function(){
        
    // Fetch the yield value
    $yield = Section::yield('page_title');
    
    // Feth the parameters
    $parameters = is_array($yield) ? $yield : (array) $yield;
        
    // Set the output text
    $text = trim(  $parameters[0] );
    
    // Determine if we should override the output format.
    $override = isSet( $parameters[1] ) ? true : false;
    
    // Check if yield is set.
    $yieldSet = strlen($text) >= 1 ? true : false;
    
    // Determine the text output depending upon yield statud.
    $text = $yieldSet ? $text : 'Untitled';

    if(Request::route()->bundle === 'admin'){
        // Return the format;
        return $override ? sprintf("<title>%s</title>\n", $text) 
                         : sprintf("<title>%s | Admin | %s</title>\n", $text, __('site.name'));        
    }
    
    // Return the format;
    return $override ? sprintf("<title>%s</title>\n", $text) 
                     : sprintf("<title>%s | %s</title>\n", $text, __('site.name'));
});

HTML::macro('buildStyle', function( $file_path = '' )
{
    return HTML::style($file_path . '?' . IoC::resolve('build_time'));
});

HTML::macro('buildScript', function( $file_path = '' )
{
    // Path to the file
    $path = (defined('LARAVEL_ENV') && LARAVEL_ENV === 'production')
            ? preg_replace('/(.*)(\.js)/', '$1-compiled$2', $file_path)
            : $file_path;
    
    return HTML::script($path . '?' . IoC::resolve('build_time'));
});

/* End of file macros.php */