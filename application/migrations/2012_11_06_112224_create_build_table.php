<?php
/**
 * The build table will be updated when significant changes are made to either
 * stylehseets or javascript files. The tasks/build.php file uses the update_at
 * value from the record and converts it to a unix timestamp that is applied
 * in query-string format to the all stylesheet and javascript file names.
 */
class Create_Build_Table {

    /**
     * Database Table Name
     * 
     * @var string
     */
    private $name = 'builds';
    
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create Table
        Schema::create( $this->name, function($table){
            
            // Set the db engine.
            $table->engine = 'InnoDB';
            
            /*
             * Set the columns
             * ---------------
             *  id          : Primary, auto-increment column.
             *  created_at  : Timestamp for when the record was created
             *  updated_at  : Timestamp for when the record was updated.
             * ---------------
             */
            $table->increments('id')->unsigned();
            $table->date('created_at');
            $table->date('updated_at');
            
        });
        
        // Insert default build record.
        Build::insert(array(
            'created_at'    => DB::raw('NOW()'),
            'updated_at'    => DB::raw('NOW()'),
        ));
        
        // Update the build_time cache.
        IoC::resolve('task', array('build'))->update();
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop Table
        Schema::drop( $this->name );
	}

}