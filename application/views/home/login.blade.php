@section('page_title', 'Client Login')


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
                    <h1>Client <small>Login</small></h1>
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
        <!-- /.span6 -->
        <!-- .span6 -->
        <div class="span6">
            <!-- .row-fluid -->
            <div class="row-fluid">
                <div class="page-header new-here">
                    <h1>New <small>here?</small> {{ HTML::link_to_route('client-register', 'Register', null, array('class' => 'btn')) }}</h1>
                    <p>Registration takes less than 30 seconds to complete.</p>
                </div>
            </div>
            <!-- /.row-fluid -->
        </div>
        <!-- /.span6 -->
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->
@endsection

@section('footer_scripts')
{{ HTML::script('js/home/login.js') }}
@endsection