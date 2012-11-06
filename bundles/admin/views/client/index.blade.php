@section('page_title', 'Clients')


@section('content')

<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <ul class="breadcrumb">
        <li><a href="{{ URL::to_route('admin-dashboard')}}">Admin Dashboard</a> <span class="divider">/</span></li>
        <li class="active">Clients</li>
        </ul>
    </div>
    <!-- /.row-fluid -->
    
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .page_header -->
        <div class="page_header">
            <h1>Client <small>List</small></h1>
            <p>The following are the current {{ __('site.name') }} vendors that have a user account on {{ __('site.name') }}.</p>
            <p><a href="{{ URL::to_route('admin-clients-add') }}" class="btn"><i class="icon-plus"></i> Add New Account</a></p>
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
                        <th>Company</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @if( count( $clients->results ) )
                    @foreach( $clients->results as $client )
                    <tr>
                        <td>{{ $client->vendor->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->username }}</td>
                        <td>
                            <div>
                                <a href="{{ URL::to_route('admin-clients-edit', array($client->id)) }}" class="btn"><i class="icon-wrench"></i> Update Account</a>
                            </div>
                            <div style="margin-top:5px">
                                <a href="{{ URL::to_route('admin-clients-forced-login', array($client->id)) }}" class="btn"><i class="icon-user"></i> Login as client</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
                
            </table>
            
        </div>
        <!-- /.span7 -->

    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div class="row-fluid">
        {{ $clients->links() }}
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->



@endsection