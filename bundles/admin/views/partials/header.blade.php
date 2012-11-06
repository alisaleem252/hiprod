<!-- .navbar.navbar-fixed-top -->
<div class="navbar navbar-fixed-top">
    <!-- .navbar-inner -->
    <div class="navbar-inner">
        <!-- .container -->
        <div class="container navbar-wrapper">
            <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a href="{{ URL::to_route('admin')}}" class="brand">{{ __('site.name') }}</a>
            <!-- .nav-collapse -->
            <div class="nav-collapse collapse">
                <!-- .nav -->
                <ul class="nav">
                    <li class="{{ (Request::route()->controller === 'home') ? ' active' : '' }}"><a href="{{ URL::to_route('admin-dashboard') }}"><i class="icon-home"></i> Dashboard</a></li>
                    <!-- .dropdown -->
                    <li class="dropdown{{ (Request::route()->controller === 'product') ? ' active' : '' }}">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-tags"></i> Products <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="nav-header">{{ __('site.name') }}</li>
                                <li><a href="{{ URL::to_route('admin-products') }}"><i class="icon-th-list"></i> View All</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ URL::to_route('admin-products-add') }}"><i class="icon-download-alt"></i> Add from ASI</a></li>
                            </ul>
                    </li>
                    <!-- /.dropdown -->
                    @if(My_Helper::isPrivilegedEmployee())
                        <!-- .dropdown -->
                        <li class="dropdown{{ (Request::route()->controller === 'vendor') ? ' active' : '' }}">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-briefcase"></i> Vendors <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-header">{{ __('site.name') }}</li>
                                    <li><a href="{{ URL::to_route('admin-vendors') }}"><i class="icon-th-list"></i> View All</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ URL::to_route('admin-vendors-add') }}"><i class="icon-plus"></i> Add from ASI</a></li>
                                </ul>
                        </li>
                        <!-- /.dropdown -->
                        <!-- .dropdown -->
                        <li class="dropdown{{ (Request::route()->controller === 'client') ? ' active' : '' }}">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user"></i> Clients <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-header">{{ __('site.name') }}</li>
                                    <li><a href="{{ URL::to_route('admin-clients') }}"><i class="icon-th-list"></i> View All</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ URL::to_route('admin-clients-add') }}"><i class="icon-plus"></i> Add</a></li>
                                </ul>
                        </li>
                        <!-- /.dropdown -->
                    @endif
                    <li><a href="{{ URL::to_route('admin-logout') }}"><i class="icon-off"></i> Log Off</a></li>
                </ul>
                <!-- .nav -->
            </div>
            <!--/.nav-collapse -->
        </div>
        <!-- .container -->
    </div>
    <!-- .navbar-inner -->
</div>
<!-- .navbar.navbar-fixed-top -->