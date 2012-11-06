<?php
/**
 * Build Task
 * 
 * @package     Tasks
 * @subpackage  Build
 * @author      Jordan Dalton <jordandalton@wrsgroup.com>
 */
class Build_Task
{
    /**
     * Default method that is executed.
     * 
     * @param type $arguments 
     */
    public function run(){}
    
    /**
     * Update the build record
     * 
     * @param type $arguments 
     */
    public static function update()
    {
        // Update the updated_at timestamp for the main build record.
        $build = Build::find(1);
        $build->timestamp();
        $build->save();
        
        // Convert to unix timestamp
        $timestamp = $build->updated_at->getTimestamp();
        
        // Update the build_time cache.
        Cache::forever('build_time', $timestamp);
        
        // Recompile all javascript files.
        IoC::resolve('task', array('compiler'))->run();
        
        return $timestamp;
    }
}
/* End of file build.php */