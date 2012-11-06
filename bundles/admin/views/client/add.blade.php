@section('page_title', 'Add Client Account')


@section('content')

<!-- .container -->
<div class="container">
    
    <!-- .row-fluid -->
    <div class="row-fluid">
        <ul class="breadcrumb">
        <li><a href="{{ URL::to_route('admin-dashboard')}}">Admin Dashboard</a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_route('admin-clients') }}">Clients</a> <span class="divider">/</span></li>
        <li class="active">Add</li>
        </ul>
    </div>
    <!-- /.row-fluid -->
    
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .span6 -->
        <div class="span7">
            <!-- .row-fluid -->
            <div class="row-fluid">
                <!-- .page-page_header -->
                <div class="page_header">
                    <h1>Add <small>New Client</small></h1>
                    <p>Once created, the system will email the client with their login information.</p>
                </div>
                <!-- .page_header -->
            </div>
            <!-- /.row-fluid -->
            <!-- .row-fluid -->
            <div class="row-fluid">
                <!-- .span12 -->
                <div class="span12">
                    {{ $form }}
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