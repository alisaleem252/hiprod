@section('page_title', 'Edit Product')

@section('content')

<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <ul class="breadcrumb">
        <li><a href="{{ URL::to_route('client-dashboard')}}">Dashboard</a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_route('client-products')}}">Products</a> <span class="divider">/</span></li>
        <li class="active">Edit</li>
        </ul>
    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .page_header -->
        <div class="page_header">
            <h1>Product <small>Update</small></h1>
            <p>Only the fields that can manually be updated are shown. All other data is delivered by ASI.</p>
        </div>
        <!-- /.page_header -->
        <hr/>
    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div class="row-fluid">
        <p>The product you're updating:</p>
    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .pull-left -->
        <div class="pull-left">
            <div class="productThumbnail media-object" style="background-image:url({{ IoC::resolve('asiProductImage', array($cache->ImageUrl)) }})"></div>
        </div>
        <!-- /.pull-left -->
        <!-- .span10 -->
        <div class="span10">
            <h4>{{ isSet($cache->Name) ? e($cache->Name) : 'N/A' }}</h4>
            <div class="row-fluid">
                {{ isSet($cache->Description) ? e($cache->Description) : 'N/A' }}
            </div>
        </div>
        <!-- /.span10 -->
        <div style="clear:both"></div>
        <hr/>
    </div>
    <!-- /.row-fluid -->
    
    
    <!-- .product_record -->
    <div class="product_record">
        <!-- .row-fluid -->
        <div class="row-fluid">
            <!-- .well -->
            
            {{ Form::open(null, 'POST', array('class' => 'well')) }}
            
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <legend>Product Information</legend>
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Catalog Page</label>
                        <input type="text" name="catalog_page" value="{{ isSet($details->catalog_page) ? $details->catalog_page : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Over/Underruns %</label>
                        <input type="text" name="over_underruns" value="{{ isSet($details->over_underruns) ? $details->over_underruns : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                </div>
                <!-- /.row-fluid -->
                <hr/>
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Imprint Area 1</label>
                        <input type="text" name="imprint_area_1" value="{{ isSet($details->imprint_area_1) ? $details->imprint_area_1 : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Imprint Location 1</label>
                        <input type="text" name="imprint_location_1" value="{{ isSet($details->imprint_location_1) ? $details->imprint_location_1 : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                </div>
                <!-- /.row-fluid -->
                <hr/>
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Imprint Area 2</label>
                        <input type="text" name="imprint_area_2" value="{{ isSet($details->imprint_area_2) ? $details->imprint_area_2 : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Imprint Location 2</label>
                        <input type="text" name="imprint_location_2" value="{{ isSet($details->imprint_location_2) ? $details->imprint_location_2 : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                </div>
                <!-- /.row-fluid -->
                
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <legend>Charges</legend>
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Net Setup</label>
                        <input type="text" name="charges_net_setup" value="{{ isSet($details->charges_net_setup) ? $details->charges_net_setup : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Exact Quantity</label>
                        <input type="text" name="charges_exact_quantity" value="{{ isSet($details->charges_exact_quantity) ? $details->charges_exact_quantity : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Reorder</label>
                        <input type="text" name="charges_reorder" value="{{ isSet($details->charges_reorder) ? $details->charges_reorder : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Rush</label>
                        <input type="text" name="charges_rush" value="{{ isSet($details->charges_rush) ? $details->charges_rush : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Logo</label>
                        <input type="text" name="charges_logo" value="{{ isSet($details->charges_logo) ? $details->charges_logo : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Straight Line</label>
                        <input type="text" name="charges_straight_line" value="{{ isSet($details->charges_straight_line) ? $details->charges_straight_line : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                </div>
                <!-- /.row-fluid -->
                
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <legend>Art Charges</legend>
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Camera Ready</label>
                        <input type="text" name="art_charges_camera_ready" value="{{ isSet($details->art_charges_camera_ready) ? $details->art_charges_camera_ready : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Set Type</label>
                        <input type="text" name="art_charges_set_type" value="{{ isSet($details->art_charges_set_type) ? $details->art_charges_set_type : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Fax Proof</label>
                        <input type="text" name="art_charges_fax_proof" value="{{ isSet($details->art_charges_fax_proof) ? $details->art_charges_fax_proof : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Size Art</label>
                        <input type="text" name="art_charges_size_art" value="{{ isSet($details->art_charges_size_art) ? $details->art_charges_size_art : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                </div>
                <!-- /.row-fluid -->
                
                
                
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <legend style="margin:20px 0 0 0">Pricing Information</legend>
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <table class="table table-striped">
                        <tr>
                            <th><label>Quantity</label></th>
                            <td><input type="text" name="pricing_quantity_1" value="{{ isSet($details->pricing_quantity_1) ? $details->pricing_quantity_1 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_quantity_2" value="{{ isSet($details->pricing_quantity_2) ? $details->pricing_quantity_2 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_quantity_3" value="{{ isSet($details->pricing_quantity_3) ? $details->pricing_quantity_3 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_quantity_4" value="{{ isSet($details->pricing_quantity_4) ? $details->pricing_quantity_4 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_quantity_5" value="{{ isSet($details->pricing_quantity_5) ? $details->pricing_quantity_5 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_quantity_6" value="{{ isSet($details->pricing_quantity_6) ? $details->pricing_quantity_6 : 'N/A' }}"/></td>
                        </tr>
                        <tr>
                            <th><label>Catalog Price</label></th>
                            <td><input type="text" name="pricing_catalog_price_1" value="{{ isSet($details->pricing_catalog_price_1) ? $details->pricing_catalog_price_1 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_catalog_price_2" value="{{ isSet($details->pricing_catalog_price_2) ? $details->pricing_catalog_price_2 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_catalog_price_3" value="{{ isSet($details->pricing_catalog_price_3) ? $details->pricing_catalog_price_3 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_catalog_price_4" value="{{ isSet($details->pricing_catalog_price_4) ? $details->pricing_catalog_price_4 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_catalog_price_5" value="{{ isSet($details->pricing_catalog_price_5) ? $details->pricing_catalog_price_5 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_catalog_price_6" value="{{ isSet($details->pricing_catalog_price_6) ? $details->pricing_catalog_price_6 : 'N/A' }}"/></td>
                        </tr>
                        <tr>
                            <th><label>Net Cost</label></th>
                            <td><input type="text" name="pricing_net_cost_1" value="{{ isSet($details->pricing_net_cost_1) ? $details->pricing_net_cost_1 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_net_cost_2" value="{{ isSet($details->pricing_net_cost_2) ? $details->pricing_net_cost_2 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_net_cost_3" value="{{ isSet($details->pricing_net_cost_3) ? $details->pricing_net_cost_3 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_net_cost_4" value="{{ isSet($details->pricing_net_cost_4) ? $details->pricing_net_cost_4 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_net_cost_5" value="{{ isSet($details->pricing_net_cost_5) ? $details->pricing_net_cost_5 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_net_cost_6" value="{{ isSet($details->pricing_net_cost_6) ? $details->pricing_net_cost_6 : 'N/A' }}"/></td>
                        </tr>
                        <tr>
                            <th><label>2nd Color Cost</label></th>
                            <td><input type="text" name="pricing_second_color_cost_1" value="{{ isSet($details->pricing_second_color_cost_1) ? $details->pricing_second_color_cost_1 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_second_color_cost_2" value="{{ isSet($details->pricing_second_color_cost_2) ? $details->pricing_second_color_cost_2 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_second_color_cost_3" value="{{ isSet($details->pricing_second_color_cost_3) ? $details->pricing_second_color_cost_3 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_second_color_cost_4" value="{{ isSet($details->pricing_second_color_cost_4) ? $details->pricing_second_color_cost_4 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_second_color_cost_5" value="{{ isSet($details->pricing_second_color_cost_5) ? $details->pricing_second_color_cost_5 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_second_color_cost_6" value="{{ isSet($details->pricing_second_color_cost_6) ? $details->pricing_second_color_cost_6 : 'N/A' }}"/></td>
                        </tr>
                        <tr>
                            <th><label>Normal 1-color w/setup</label></th>
                            <td><input type="text" name="pricing_normal_one_color_cost_with_setup_1" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_1) ? $details->pricing_normal_one_color_cost_with_setup_1 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_normal_one_color_cost_with_setup_2" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_2) ? $details->pricing_normal_one_color_cost_with_setup_2 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_normal_one_color_cost_with_setup_3" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_3) ? $details->pricing_normal_one_color_cost_with_setup_3 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_normal_one_color_cost_with_setup_4" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_4) ? $details->pricing_normal_one_color_cost_with_setup_4 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_normal_one_color_cost_with_setup_5" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_5) ? $details->pricing_normal_one_color_cost_with_setup_5 : 'N/A' }}"/></td>
                            <td><input type="text" name="pricing_normal_one_color_cost_with_setup_6" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_6) ? $details->pricing_normal_one_color_cost_with_setup_6 : 'N/A' }}"/></td>
                        </tr>
                    </table>
                </div>
                <!-- /.row-fluid -->
<?php
        // Form Buttons
        echo Form::actions(array(
                Form::submit('Update Record!', array('class' => 'btn btn-primary')),
        ));
    ?>
                
            </form>
            <!-- .well -->

        </div>
        <!-- /.row-fluid -->
    </div>
    <!-- /.product_record -->
</div>
<!-- /.container -->

@endsection