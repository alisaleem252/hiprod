<?php

class Create_User_Admin_Table {

    /**
     * Database Table Name
     * 
     * @var string
     */
    public $name = 'users_admins';
    
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create Table
        Schema::create( $this->name, function( $table ){
            
            // DB Engine
            $table->engine = 'InnoDB';
            
            // DB Columns
            $table->increments('id');
            $table->date('created_at')->nullable();
            $table->string('username');
            $table->date('updated_at')->nullable();
        });
        
        // Make Jordan Dalton administrator by default.
        User_Admin::create(array(
            'username' => 'jdalton'
        ));
        
        // Make Jordan Dalton administrator by default.
        User_Admin::create(array(
            'username' => 'blivings'
        ));
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