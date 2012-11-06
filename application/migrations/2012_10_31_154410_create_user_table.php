<?php

class Create_User_Table {

    /**
     * Database Table Name
     * 
     * @var string
     */
    public $name = 'users';
    
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
            $table->increments('id')->unsigned();
            $table->integer('asi_number')->unsigned()->index();
            $table->date('created_at');
            $table->string('email', 255)->index();
            $table->string('password', 60);
            $table->date('updated_at');
            $table->string('username', 30)->index();
            $table->integer('vendor_id')->unsigned()->index();
        });
        
        // Make Jordan Dalton administrator by default.
        /*
        User::create(array(
            'asi_number' => 61125,
            'email'      => 'jordandalton@wrsgroup.com',
            'password'   => 'mrdalton09',
            'username'   => 'jdalton'
        ));
         * 
         */
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