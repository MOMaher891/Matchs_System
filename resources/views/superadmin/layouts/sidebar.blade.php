<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('super_admin.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#supder_admin" aria-expanded="false"
                aria-controls="supder_admin">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Admins</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="supder_admin">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('super_admin.admins.index') }}">Show
                            Admins</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('super_admin.admins.create') }}">Add
                            Admin</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('super_admin.users.index') }}">Show
                            Users</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('super_admin.users.create') }}">Add
                            User</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#stadium" aria-expanded="false" aria-controls="stadium">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Stadiums</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="stadium">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('super_admin.stadiums.index') }}">Show
                            Stadiums</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('super_admin.stadiums.create') }}">Add
                            Stadium</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#clients" aria-expanded="false" aria-controls="clients">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Clients</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="clients">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('super_admin.clients.index') }}">Show
                            Clients</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route('super_admin.clients.create') }}">Add
                            Client</a> --}}
        </li>
    </ul>
    </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
            aria-controls="form-elements">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Form elements</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a>
                </li>
            </ul>
        </div>
    </li>


    </ul>
</nav>
<!-- partial -->
