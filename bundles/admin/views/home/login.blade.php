@section('page_title', 'Staff Login')

@section('content')

<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .span6 -->
        <div class="span6">
            <!-- .row-fluid -->
            <div class="row-fluid">
                <!-- .page-page_header -->
                <div class="page_header">
                    <h1>Staff <small>Login</small></h1>
                    <p>Login is required to proceed.</p>
                </div>
                <!-- .page_header -->
            </div>
            <!-- /.row-fluid -->
            <!-- .row-fluid -->
            <div class="row-fluid">
                <!-- .span12 -->
                <div class="span12">
                    {{ $loginForm }}
                </div>
                <!-- .span12 -->
            </div>
            <!-- /.row-fluid -->
        </div>
        <!-- .span6 -->
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->
@endsection