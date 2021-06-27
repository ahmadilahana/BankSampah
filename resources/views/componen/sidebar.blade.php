<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BSampah <sup>KU</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Users
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('user/nasabah') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="/user/nasabah">
            <i class="fas fa-user-friends"></i>
            <span>Nasabah</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('user/pengurus1') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="/user/pengurus1">
            <i class="fas fa-user-friends"></i>
            <span>Pengurus 1</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('user/pengurus2') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="/user/pengurus2">
            <i class="fas fa-user-friends"></i>
            <span>Pengurus 2</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('user/bendahara') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="/user/bendahara">
            <i class="fas fa-user-friends"></i>
            <span>Bendahara</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>

    <li class="nav-item {{ Request::is('jenis_sampah') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="/jenis_sampah">
            <i class="fas fa-user-friends"></i>
            <span>Jenis Sampah</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
