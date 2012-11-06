<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <li class="{{ (Request::route()->action['as'] === 'client-dashboard' ) ? 'active' : '' }}">
            <a href="{{ URL::to_route('client-dashboard') }}"><i class="icon-home"></i> Dashboard</a>
        </li>
        <li class="nav-header">My Products</li>
        <li class="{{ (Request::route()->action['as'] === 'client-products' ) ? 'active' : '' }}">
            <a href="{{ URL::to_route('client-products') }}"><i class="icon-tags"></i> View</a>
        </li>
        <li class="nav-header">My Account</li>
        <li class="{{ (Request::route()->action['as'] === 'client-account' ) ? 'active' : '' }}">
            <a href="{{ URL::to_route('client-account') }}"><i class="icon-user"></i> Update Information</a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="{{ URL::to_route('logout') }}"><i class="icon-off"></i> Logout</a>
        </li>
    </ul>
</div>