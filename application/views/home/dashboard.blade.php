@section('page_title', 'Client Dashboard')

@section('content')
<!-- .container -->
<div class="container" style="padding-top:15px">    
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .span3 -->
        <div class="span3">
            {{ $sidebar }}
        </div>
        <!-- /.span3 -->
        <!-- .span9 -->
        <div class="span9">
            <!-- .page_header -->
            <div class="page_header">
                <h1>Client <small>Dashboard</small></h1>
                <p>Welcome to your {{ __('site.name') }} client dashboard.</p>
            </div>
            <!-- /.page_header -->
        </div>
        <!-- /.span9 -->
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->
@endsection