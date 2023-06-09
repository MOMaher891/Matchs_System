<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav position-fixed">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('request.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Requests</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.stadiums.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Stadiums</span>
            </a>
        </li>

        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.bookings.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Bookings</span>
            </a>
        </li>

    </ul>
</nav>
<!-- partial -->
