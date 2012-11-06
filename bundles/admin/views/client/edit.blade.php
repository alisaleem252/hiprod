@section('page_title', 'Edit Client Account')


@section('content')

    <!-- .container -->
    <div class="container">

        <!-- .row-fluid -->
        <div class="row-fluid">
            <ul class="breadcrumb">
            <li><a href="{{ URL::to_route('admin-dashboard')}}">Admin Dashboard</a> <span class="divider">/</span></li>
            <li><a href="{{ URL::to_route('admin-clients')}}">Clients</a> <span class="divider">/</span></li>
            <li class="active">Edit</li>
            </ul>
        </div>
        <!-- /.row-fluid -->

        <!-- .row-fluid -->
        <div class="row-fluid">
            <!-- .span6 -->
            <div class="span7">
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <!-- .page_header -->
                    <div class="page_header">
                        <h1>Edit <small>Client</small></h1>
                        <p>Upon update, client will be notified via email of changes to their account.</p>
                    </div>
                    <!-- /.page_header -->
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