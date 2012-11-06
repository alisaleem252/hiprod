@section('page_title', array('My HiProd Products'))


@section('content')
<!-- .container -->
<div class="container" style="padding-top:15px">    
    <!-- .row-fluid -->
    <div class="row-fluid">    
        <div class="span3">
            {{ $sidebar }}
        </div>
        <!-- .span9 -->
        <div class="span9">
            <!-- .page_header -->
            <div class="page_header">
                <h1>My <small>{{ __('site.name') }} Products</small></h1>
                <p>The following, are your products that are listed on {{ __('site.name') }}.</p>
            </div>
            <!-- /.page_header -->
            <!-- .row-fluid -->
            <div class="row-fluid rightFade">
                {{ $search_form }}
            </div>
            <!-- /.row-fluid -->
            <!-- .row-fluid -->
            <div class="row-fluid">
                <!-- /.span12 -->
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
                                    <div style="margin-top:5px">
                                        <a href="{{ URL::to_route('client-products-edit', array($product->id)) }}" class="btn" target="_blank"><i class="icon-pencil"></i> Edit Record</a>
                                    </div>
                                </td>
                            </tr>
                            <?php /*break;*/?>
                            @endforeach
                        @endif
                    </table>
                </div>
                <!-- .span12 -->
            </div>
            <!-- /.row-fluid -->
            <!-- .row-fluid -->
            <div class="row-fluid">
                {{ $products->links() }}
            </div>
            <!-- .row-fluid -->
        </div>
        <!-- .span9 -->
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->
@endsection