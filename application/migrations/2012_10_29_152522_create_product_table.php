<?php

class Create_Product_Table {
    
    /**
     * Database Table Name
     * 
     * @var string
     */
    public $name = 'products';
    
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create Table
        Schema::create( $this->name, function($table){
            
            // Set the DB engine
            $table->engine = 'InnoDB';
            
            // Set the table columns
            $table->increments('id');
            $table->integer('asi_id')->unsigned();
            $table->date('created_at')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('vendor_id')->unsigned();
            $table->date('updated_at')->nullable(); 
        });
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