<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPD JABAR</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Transaksi Pembelian -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-cash-register"></i>
            <span>Transaksi Pembelian</span></a>
    </li>

    <!-- Nav Item - Daftar Transaksi -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-clipboard-list"></i>
            <span>Daftar Transaksi</span></a>
    </li>

    @if (auth()->user()->role == "admin")
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Pengaturan
        </div>
        <!-- Nav Item - Master Barang -->
        <li class="nav-item {{ Route::is('master-barang*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('master-barang.index') }}">
                <i class="fas fa-book"></i>
                <span>Master Barang</span></a>
        </li>
        <!-- Nav Item - Master Barang -->
        <li class="nav-item {{ Route::is('user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-user"></i>
                <span>User</span></a>
        </li>
    @endif




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
