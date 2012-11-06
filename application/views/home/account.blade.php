@section('page_title', 'Update Account Information')

@section('content')
<!-- .container -->
<div class="container" style="padding-top:15px">    
    <!-- .row-fluid -->
    <div class="row-fluid">    
        <div class="span3">
            {{ $sidebar }}
        </div>
        
        <div class="span9">
            <!-- .page_header -->
            <div class="page_header">
                <h1>Account <small>Information</small></h1>
                <p>Update your account information using the form below.</p>
            </div>
            <!-- /.page_header -->
            
            <!-- .row-fluid -->
            <div class="row-fluid">
                {{ $form }}
            </div>
            <!-- /.row-fluid -->
        </div>
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->
@endsection