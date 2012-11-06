@section('page_title', 'Dashboard')


@section('content')

<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .page_header -->
        <div class="page_header">
            <h1>Admin <small>Dashboard</small></h1>
            <p>Welcome to the admin section, {{ Session::get('firstname') }}.</p>
        </div>
        <!-- /.page_header -->        
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->

@endsection