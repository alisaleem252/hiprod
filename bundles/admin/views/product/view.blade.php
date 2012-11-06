@section('page_title', 'Product View')

@section('content')

<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <ul class="breadcrumb">
        <li><a href="{{ URL::to_route('admin-dashboard')}}">Admin Dashboard</a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_route('admin-products')}}">Products</a> <span class="divider">/</span></li>
        <li class="active">View</li>
        </ul>
    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .page_header -->
        <div class="page_header">
            <h1>Product <small>View</small></h1>
            <p>You're currently viewing product #{{ $product->id }}.</p>
            <p><a href="{{ URL::to_route('admin-products-edit', array($product->id)) }}" class="btn"><i class="icon-pencil"></i> Edit Record</a></p>
        </div>
        <!-- /.page_header -->        
    </div>
    <!-- /.row-fluid -->
    <!-- .product_record -->
    <div class="product_record">
        <!-- .row-fluid -->
        <div class="row-fluid">
            <!-- .well -->
            <form class="well">
                
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <legend>Product Information</legend>
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Product #</label>
                        <input type="text" value="{{ $product->id }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Vendor #</label>
                        <input type="text" value="{{ isSet($cache->Id) ? e($cache->Id) : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Catalog Page</label>
                        <input type="text" value="{{ isSet($details->catalog_page) ? $details->catalog_page : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                </div>
                <!-- /.row-fluid -->
                <hr/>
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span12 -->
                    <div class="span12">
                        <label>Product Name</label>
                        <input type="text" value="{{ isSet($cache->Name) ? e($cache->Name) : 'N/A' }}"/>
                    </div>
                    <!-- /.span12 -->
                </div>
                <!-- /.row-fluid -->
                <hr/>
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span12 -->
                    <div class="span12">
                        <label>Product Description</label>
                        <textarea rows="3">{{ isSet($cache->Description) ? e($cache->Description) : 'N/A' }}"</textarea>
                    </div>
                    <!-- /.span12 -->
                </div>
                <!-- /.row-fluid -->
                <hr/>
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span12 -->
                    <div class="span12">
                        <label>Imprint Colors</label>
                        <textarea rows="3">{{ isSet($cache->Imprinting->Colors->Values) ? e(implode(', ', $cache->Imprinting->Colors->Values)) : 'N/A' }}</textarea>
                    </div>
                    <!-- /.span12 -->
                </div>
                <!-- /.row-fluid -->
                <hr/>
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span4 -->
                    <div class="span4">
                        <label>FOB</label>
                        <input type="text" value="{{ isSet($cache->Shipping->FOBPoints->Values) ? e(implode(', ', $cache->Shipping->FOBPoints->Values)) : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Lead Time</label>
                        <input type="text" value="{{ isSet($cache->ProductionTime[0]->Name) ? e($cache->ProductionTime[0]->Name) : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->                    
                    <div class="span4">
                        <label>Ship Weight</label>
                        <input type="text" value="{{ isSet($cache->Shipping->Weight->Values[0]) ? e($cache->Shipping->Weight->Values[0]) : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                </div>
                <!-- /.row-fluid -->
                <hr/>
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Over/Underruns %</label>
                        <input type="text" value="{{ isSet($details->over_underruns) ? $details->over_underruns : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Product Size</label>
                        <input type="text" value="{{ isSet($cache->Attributes->Sizes->Values[0]) ? e($cache->Attributes->Sizes->Values[0]) : 'N/A' }}"/>
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
                        <input type="text" value="{{ isSet($details->imprint_area_1) ? $details->imprint_area_1 : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Imprint Location 1</label>
                        <input type="text" value="{{ isSet($details->imprint_location_1) ? $details->imprint_location_1 : 'N/A' }}"/>
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
                        <input type="text" value="{{ isSet($details->imprint_area_2) ? $details->imprint_area_2 : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Imprint Location 2</label>
                        <input type="text" value="{{ isSet($details->imprint_location_2) ? $details->imprint_location_2 : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                </div>
                <!-- /.row-fluid -->
                <hr/>
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Imprint Methods</label>
                        <input type="text" value="{{ isSet($cache->Imprinting->Methods->Values[0]->Name) ? e($cache->Imprinting->Methods->Values[0]->Name) : 'N/A' }}"/>
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
                        <input type="text" value="{{ isSet($details->charges_net_setup) ? $details->charges_net_setup : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Exact Quantity</label>
                        <input type="text" value="{{ isSet($details->charges_exact_quantity) ? $details->charges_exact_quantity : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Reorder</label>
                        <input type="text" value="{{ isSet($details->charges_reorder) ? $details->charges_reorder : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Rush</label>
                        <input type="text" value="{{ isSet($details->charges_rush) ? $details->charges_rush : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Logo</label>
                        <input type="text" value="{{ isSet($details->charges_logo) ? $details->charges_logo : 'N/A' }}"/>
                    </div>
                    <!-- /.span4 -->
                    <!-- .span4 -->
                    <div class="span4">
                        <label>Straight Line</label>
                        <input type="text" value="{{ isSet($details->charges_straight_line) ? $details->charges_straight_line : 'N/A' }}"/>
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
                        <input type="text" value="{{ isSet($details->art_charges_camera_ready) ? $details->art_charges_camera_ready : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Set Type</label>
                        <input type="text" value="{{ isSet($details->art_charges_set_type) ? $details->art_charges_set_type : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Fax Proof</label>
                        <input type="text" value="{{ isSet($details->art_charges_fax_proof) ? $details->art_charges_fax_proof : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Size Art</label>
                        <input type="text" value="{{ isSet($details->art_charges_size_art) ? $details->art_charges_size_art : 'N/A' }}"/>
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
                            <td><input type="text" value="{{ isSet($details->pricing_quantity_1) ? $details->pricing_quantity_1 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_quantity_2) ? $details->pricing_quantity_2 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_quantity_3) ? $details->pricing_quantity_3 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_quantity_4) ? $details->pricing_quantity_4 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_quantity_5) ? $details->pricing_quantity_5 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_quantity_6) ? $details->pricing_quantity_6 : 'N/A' }}"/></td>
                        </tr>
                        <tr>
                            <th><label>Catalog Price</label></th>
                            <td><input type="text" value="{{ isSet($details->pricing_catalog_price_1) ? $details->pricing_catalog_price_1 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_catalog_price_2) ? $details->pricing_catalog_price_2 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_catalog_price_3) ? $details->pricing_catalog_price_3 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_catalog_price_4) ? $details->pricing_catalog_price_4 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_catalog_price_5) ? $details->pricing_catalog_price_5 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_catalog_price_6) ? $details->pricing_catalog_price_6 : 'N/A' }}"/></td>
                        </tr>
                        <tr>
                            <th><label>Net Cost</label></th>
                            <td><input type="text" value="{{ isSet($details->pricing_net_cost_1) ? $details->pricing_net_cost_1 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_net_cost_2) ? $details->pricing_net_cost_2 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_net_cost_3) ? $details->pricing_net_cost_3 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_net_cost_4) ? $details->pricing_net_cost_4 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_net_cost_5) ? $details->pricing_net_cost_5 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_net_cost_6) ? $details->pricing_net_cost_6 : 'N/A' }}"/></td>
                        </tr>
                        <tr>
                            <th><label>2nd Color Cost</label></th>
                            <td><input type="text" value="{{ isSet($details->pricing_second_color_cost_1) ? $details->pricing_second_color_cost_1 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_second_color_cost_2) ? $details->pricing_second_color_cost_2 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_second_color_cost_3) ? $details->pricing_second_color_cost_3 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_second_color_cost_4) ? $details->pricing_second_color_cost_4 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_second_color_cost_5) ? $details->pricing_second_color_cost_5 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_second_color_cost_6) ? $details->pricing_second_color_cost_6 : 'N/A' }}"/></td>
                        </tr>
                        <tr>
                            <th><label>Normal 1-color w/setup</label></th>
                            <td><input type="text" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_1) ? $details->pricing_normal_one_color_cost_with_setup_1 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_2) ? $details->pricing_normal_one_color_cost_with_setup_2 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_3) ? $details->pricing_normal_one_color_cost_with_setup_3 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_4) ? $details->pricing_normal_one_color_cost_with_setup_4 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_5) ? $details->pricing_normal_one_color_cost_with_setup_5 : 'N/A' }}"/></td>
                            <td><input type="text" value="{{ isSet($details->pricing_normal_one_color_cost_with_setup_6) ? $details->pricing_normal_one_color_cost_with_setup_6 : 'N/A' }}"/></td>
                        </tr>
                    </table>
                </div>
                <!-- /.row-fluid -->
                
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <legend>Vendor Details</legend>
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Name</label>
                        <input type="text" value="{{ isSet($vendor->Name) ? $vendor->Name : '' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span2 -->
                    <div class="span2">
                        <label>Vendor Account #</label>
                        <input type="text" value="[TBA]"/>
                    </div>
                    <!-- /.span2 -->
                    <!-- .span2 -->
                    <div class="span2">
                        <label>Vendor ASI #</label>
                        <input type="text" value="{{ isSet($vendor->AsiNumber) ? $vendor->AsiNumber : '' }}"/>
                    </div>
                    <!-- /.span2 -->
                    <!-- .span2 -->
                    <div class="span2">
                        <label>Vendor CoOp #</label>
                        <input type="text" value="[TBA]"/>
                    </div>
                    <!-- /.span2 -->
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span6">
                        <label>Address</label>
                        <input type="text" value="{{ isSet($vendor->Addresses->Primary->Street1) ? $vendor->Addresses->Primary->Street1 : 'N/A' }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span2 -->
                    <div class="span2">
                        <label>City</label>
                        <input type="text" value="{{ isSet($vendor->Addresses->Primary->City) ? $vendor->Addresses->Primary->City : 'N/A' }}"/>
                    </div>
                    <!-- /.span2 -->
                    <!-- .span2 -->
                    <div class="span2">
                        <label>State</label>
                        <input type="text" value="{{ isSet($vendor->Addresses->Primary->State) ? $vendor->Addresses->Primary->State : 'N/A' }}"/>
                    </div>
                    <!-- /.span2 -->
                    <!-- .span2 -->
                    <div class="span2">
                        <label>Zip</label>
                        <input type="text" value="{{ isSet($vendor->Addresses->Primary->Zip) ? $vendor->Addresses->Primary->Zip : 'N/A' }}"/>
                    </div>
                    <!-- /.span2 -->
                </div>
                <!-- /.row-fluid -->
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .span6 -->
                    <div class="span3">
                        <label>Phone</label>
                        <input type="text" value="{{ isSet($vendor->Phone->TollFree) ? $vendor->Phone->TollFree : (isSet($vendor->Phone->Work) ? $vendor->Phone->Work : 'N/A') }}"/>
                    </div>
                    <!-- /.span6 -->
                    <!-- .span2 -->
                    <div class="span3">
                        <label>Fax</label>
                        <input type="text" value="{{ isSet($vendor->Fax->TollFree) ? $vendor->Fax->TollFree : (isSet($vendor->Fax->Work) ? $vendor->Fax->Work : 'N/A') }}"/>
                    </div>
                    <!-- /.span2 -->
                    <!-- .span2 -->
                    <div class="span6">
                        <label>Website</label>
                        <input type="text" value="{{ isSet($vendor->Websites[0]) ? $vendor->Websites[0] : '' }}"/>
                    </div>
                    <!-- /.span2 -->
                </div>
                <!-- /.row-fluid -->
            </form>
            <!-- .well -->

        </div>
        <!-- /.row-fluid -->
    </div>
    <!-- /.product_record -->
</div>
<!-- /.container -->

@endsection

@section('footer_scripts')
    {{ HTML::buildScript('bundles/admin/js/product/view.js') }}
@endsection