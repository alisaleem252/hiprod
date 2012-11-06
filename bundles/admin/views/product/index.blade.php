@section('page_title', 'Products')

@section('content')

<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <ul class="breadcrumb">
        <li><a href="{{ URL::to_route('admin-dashboard')}}">Admin Dashboard</a> <span class="divider">/</span></li>
        <li class="active">Products</li>
        </ul>
    </div>
    <!-- /.row-fluid -->
    
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .page_header -->
        <div class="page_header">
            <h1>Product <small>List</small></h1>
            <p>The following are the current {{ __('site.name') }} products.</p>
            <p><a href="{{ URL::to_route('admin-products-add') }}" class="btn"><i class="icon-download"></i> Import Product(s) from ASI</a></p>
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
        <div class="span12">
            
            <table class="table table-bordered table-striped" style="margin-top:10px">   
                <thead>
                    <tr>
                        <th style="width:110px;text-align:center">Image</th>
                        <th>Product Information</th>
                        <th style="width:125px;text-align:center">Actions</th>
                    </tr>
                </thead>
                                
                @if( count( $products->results ) )
                    @foreach( $products->results as $product )
                    <?php $cache = IoC::resolve('asiSupplierProductRecordCache', array($product->asi_id)); ?>
                    <tr>
                        <td>
                            <div class="productThumbnail" style="background-image:url({{ IoC::resolve('asiProductImage', array($cache->ImageUrl)) }})"></div>
                        </td>
                        <td>
                            <h4>{{ $cache->Name }}</h4>
                            <p>{{ $cache->Description }}</p>
                        </td>
                        <td>
                            <div>
                                <a href="{{ URL::to_route('admin-products-view', array($product->id)) }}" class="btn" target="_blank"><i class="icon-eye-open"></i> View Record</a>
                            </div>
                            <div style="margin-top:5px">
                                <a href="{{ URL::to_route('admin-products-edit', array($product->id)) }}" class="btn" target="_blank"><i class="icon-pencil"></i> Edit Record</a>
                            </div>
                        </td>
                    </tr>
                    <?php /*break;*/?>
                    @endforeach
                @endif
            </table>
            
        </div>
        <!-- /.span7 -->

    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div class="row-fluid">
        {{ $products->links() }}
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->

@endsection