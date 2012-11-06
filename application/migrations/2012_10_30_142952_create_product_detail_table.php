<?php

class Create_Product_Detail_Table {

    /**
     * Database Table Name
     * 
     * @var string
     */
    private $name = 'products_details';
    
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create Table
        Schema::create($this->name, function($table){
            
            // Set the db engine
            $table->engine = 'InnoDB';
            
            // Set the table columns.
            $table->increments('id');

            // Art Charges
            $table->string('art_charges_camera_ready')->nullable()->default('N/A');
            $table->string('art_charges_set_type')->nullable()->default('N/A');
            $table->string('art_charges_fax_proof')->nullable()->default('N/A');
            $table->string('art_charges_size_art')->nullable()->default('N/A');
            
            $table->string('catalog_page')->nullable()->default('N/A');
            
            // Charges
            $table->string('charges_net_setup')->nullable()->default('N/A');
            $table->string('charges_exact_quantity')->nullable()->default('N/A');
            $table->string('charges_logo')->nullable()->default('N/A');
            $table->string('charges_reorder')->nullable()->default('N/A');
            $table->string('charges_rush')->nullable()->default('N/A');
            $table->string('charges_straight_line')->nullable()->default('N/A');

            $table->date('created_at')->nullable();
            
            // Imprint
            $table->string('imprint_area_1')->nullable()->default('N/A');
            $table->string('imprint_area_2')->nullable()->default('N/A');
            $table->string('imprint_location_1')->nullable()->default('N/A');
            $table->string('imprint_location_2')->nullable()->default('N/A');
            
            $table->string('net_setup')->nullable()->default('N/A');
            $table->text('notes')->nullable();
            $table->string('over_underruns')->nullable()->default('N/A');
            
            // Pricing Information
            $table->string('pricing_catalog_price_1')->nullable()->default('N/A');
            $table->string('pricing_catalog_price_2')->nullable()->default('N/A');
            $table->string('pricing_catalog_price_3')->nullable()->default('N/A');
            $table->string('pricing_catalog_price_4')->nullable()->default('N/A');
            $table->string('pricing_catalog_price_5')->nullable()->default('N/A');
            $table->string('pricing_catalog_price_6')->nullable()->default('N/A');
            
            $table->string('pricing_net_cost_1')->nullable()->default('N/A');
            $table->string('pricing_net_cost_2')->nullable()->default('N/A');
            $table->string('pricing_net_cost_3')->nullable()->default('N/A');
            $table->string('pricing_net_cost_4')->nullable()->default('N/A');
            $table->string('pricing_net_cost_5')->nullable()->default('N/A');
            $table->string('pricing_net_cost_6')->nullable()->default('N/A');
            
            $table->string('pricing_normal_one_color_cost_with_setup_1')->nullable()->default('N/A');
            $table->string('pricing_normal_one_color_cost_with_setup_2')->nullable()->default('N/A');
            $table->string('pricing_normal_one_color_cost_with_setup_3')->nullable()->default('N/A');
            $table->string('pricing_normal_one_color_cost_with_setup_4')->nullable()->default('N/A');
            $table->string('pricing_normal_one_color_cost_with_setup_5')->nullable()->default('N/A');
            $table->string('pricing_normal_one_color_cost_with_setup_6')->nullable()->default('N/A');
            
            $table->string('pricing_quantity_1')->nullable()->default('N/A');
            $table->string('pricing_quantity_2')->nullable()->default('N/A');
            $table->string('pricing_quantity_3')->nullable()->default('N/A');
            $table->string('pricing_quantity_4')->nullable()->default('N/A');
            $table->string('pricing_quantity_5')->nullable()->default('N/A');
            $table->string('pricing_quantity_6')->nullable()->default('N/A');
            
            $table->string('pricing_second_color_cost_1')->nullable()->default('N/A');
            $table->string('pricing_second_color_cost_2')->nullable()->default('N/A');
            $table->string('pricing_second_color_cost_3')->nullable()->default('N/A');
            $table->string('pricing_second_color_cost_4')->nullable()->default('N/A');
            $table->string('pricing_second_color_cost_5')->nullable()->default('N/A');
            $table->string('pricing_second_color_cost_6')->nullable()->default('N/A');
            
            $table->integer('product_id')->unsigned();
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