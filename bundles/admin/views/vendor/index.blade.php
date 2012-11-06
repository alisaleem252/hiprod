@section('page_title', 'Vendors')

@section('content')

<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <ul class="breadcrumb">
        <li><a href="{{ URL::to_route('admin-dashboard')}}">Admin Dashboard</a> <span class="divider">/</span></li>
        <li class="active">Vendors</li>
        </ul>
    </div>
    <!-- /.row-fluid -->
    
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .page_header -->
        <div class="page_header">
            <h1>Vendor <small>List</small></h1>
            <p>The following are current HiProd vendors.</p>
            <p><a href="{{ URL::to_route('admin-vendors-add') }}" class="btn"><i class="icon-download"></i> Import Vendor(s) from ASI</a></p>
        </div>
        <!-- /.page_header -->        
    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div class="row-fluid rightFade">
        <div class="span4">
            {{ $search_form }}   
        </div>   
    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div class="row-fluid">
        
        <!-- .span7 -->
        <div class="span7">
            
            <table class="table table-bordered table-striped" style="margin-top:10px">   
                <thead>
                    <tr>
                        <th>Vendor Information</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                @if( count( $vendors->results ) )
                    @foreach( $vendors->results as $vendor )
                        <?php $cache    = IoC::resolve('asiSupplierRecordCache', array($vendor->asi_id)); ?>
                        <?php $address  = $cache->Addresses->Primary;?>
                        <?php $phone    = $cache->Phone;?>
                        <?php $fax      = $cache->Fax;?>
                    <tr>
                        <td>
                            <p><strong>{{ $cache->Name }}</strong> (Asi #{{ $cache->AsiNumber }})</p>
                            <p>{{ $address->Street1 }}<br/>
                               {{ $address->City }}, {{ $address->State }} {{$address->Zip }}<br/>
                            </p>
                            <p>Phone: {{ isSet($phone->Work) ? $phone->Work : 'N/A' }}<br/>
                               Toll-Free: {{ isSet($phone->TollFree) ? $phone->TollFree : 'N/A' }}<br/>
                               Fax: {{ isSet($fax->Work) ? $fax->Work : 'N/A' }}<br/>
                            </p>
                            <p>Websites<br/>
                                @foreach($cache->Websites as $website)
                                {{ HTML::link($website, null, array('target' => '_blank')) }} <br/>
                                @endforeach
                            </p>

                            <?php //print_r( $cache );?>
                        </td>
                        <td>
                            <p><a href="{{ URL::to_route('admin-products') . '?name=' . urlencode('asi_number:' . $cache->AsiNumber) }}" class="btn btn-small btn-primary">View HiProd Products</a></p>
                            <p><a href="{{ URL::to_route('admin-products-add') . '?selectAsiNumber=' . $cache->AsiNumber }}" class="btn btn-small ">Import Products from ASI</a></p>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">There are no records to list.</td>
                    </tr>
                @endif
            </table>
            
        </div>
        <!-- /.span7 -->

    </div>
    <!-- /.row-fluid -->
    
    <!-- .row-fluid -->
    <div class="row-fluid">
        {{ $vendors->links() }}
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->

@endsection