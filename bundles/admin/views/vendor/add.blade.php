@section('page_title', 'Vendor Search');

@section('content')

<!-- .container -->
<div class="container">
    <!-- .row-fluid -->
    <div class="row-fluid">
        <ul class="breadcrumb">
        <li><a href="{{ URL::to_route('admin-dashboard')}}">Admin Dashboard</a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_route('admin-vendors') }}">Vendors</a> <span class="divider">/</span></li>
        <li class="active">Add</li>
        </ul>
    </div>
    <!-- /.row-fluid -->
    
    <!-- .row-fluid -->
    <div id="importingIndicator" class="row-fluid">
        <!-- .span6 -->
        <div class="span6">
            <p><i class="loadingIndicator"></i> Importing vendor(s) from ASI.</p>
            <div style="clear:both"></div>
        </div>
        <!-- /.span6 -->
    </div>
    <!-- /.row-fluid -->
    
    <!-- .row-fluid -->
    <div id="importAlert" class="row-fluid">
        <div class="alert alert-success">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <strong>Vendor import is complete!</strong> 
        </div>
    </div>
    <!-- /.row-fluid -->
    
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .page_header -->
        <div class="page_header">
            <h1>Add <small>New Vendor</small></h1>
            <p>Import vendor profile from ASI Central.</p>
        </div>
        <!-- /.page_header -->        
    </div>
    <!-- /.row-fluid -->
    <hr/>
    <!-- .row-fluid -->
    <div class="row-fluid">
        <!-- .span4 -->
        <div class="span4">
            {{ $search_form }}
        </div>
        <!-- /.span4 -->
                
        <!-- .span4.btn-group -->
        <div class="span3">
            <div style="clear:both"></div>
            <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">
                    <strong class="selectedCount">0</strong> record(s) selected <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="viewSelected" data-toggle="modal" href="#myModal"><i class="icon-eye-open"></i> View</a></li>
                    <li class="divider"></li>
                    <li><a class="importSelected" href="#"><i class="icon-download"></i> Run Import</a></li>
                </ul>
            </div>
        </div>                
        <!-- /.span4 -->
    </div>
    <!-- /.row-fluid -->
    <hr/>   
    <!-- .row-fluid -->
    <div id="loadingIndicator" class="row-fluid">
        <!-- .span6 -->
        <div class="span6">
            <p><i class="loadingIndicator"></i> Searching for records.</p>
            <div style="clear:both"></div>
        </div>
        <!-- /.span6 -->
    </div>
    <!-- /.row-fluid -->
    <!-- .row-fluid -->
    <div id="resultsContainer" class="row-fluid">
        <!-- .span6 -->
        <div class="span6">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th></th>
                        <th>Vendor Details</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.span6 --> 
    </div>
    <!-- /.row-fluid -->
</div>
<!-- /.container -->


<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Vendor Import</h3>
    </div>
    <div class="modal-body">
        <p>The following vendors have been selected to be imported into HiProd.</p>
        <table id="previewTable" class="table">
            <thead>
                <tr>
                    <th>Vendor Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
</div>

@endsection

@section('footer_scripts')
    {{ HTML::buildScript('bundles/admin/js/vendor/add.js') }}
@endsection