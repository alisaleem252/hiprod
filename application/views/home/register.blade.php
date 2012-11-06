@section('page_title', 'Client Sign Up')

@section('content')
<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .span6 -->
        <div class="span7">
            <!-- .row-fluid -->
            <div class="row-fluid">
                <!-- .page-page_header -->
                <div class="page_header">
                    <h1>Client <small>Signup</small></h1>
                    <p>Registration takes less than a minute.</p>
                </div>
                <!-- .page_header -->
            </div>
            <!-- /.row-fluid -->
            <!-- .row-fluid -->
            <div class="row-fluid">
                <!-- .span12 -->
                <div class="span12">
                    {{ $registrationForm }}
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

@section('footer_scripts')
{{ HTML::script('js/home/register.js') }}
@endsection