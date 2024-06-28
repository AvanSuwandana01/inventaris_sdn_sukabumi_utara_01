<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">Inventaris SDN Sukabumi Utara 01</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::route()->getName() == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fa fa-columns"></i> <span>Dashboard</span>
            </a>
        </li>
        @if (auth()->user()->role == 'admin')
            <li class="menu-header">Data Barang</li>
            <li class="{{ Request::route()->getName() == 'barangs.index' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('barangs.index') }}">
                    <i class="fa fa-box"></i> <span>Data Barang</span>
                </a>
            </li>
        @endif

        <li class="menu-header">Data Peminjaman</li>
        <li class="{{ Request::route()->getName() == 'peminjaman.index' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('peminjaman.index') }}">
                <i class="fa fa-handshake"></i> <span>Data Peminjaman</span>
            </a>
        </li>

        <li class="menu-header">Data Pengembalian</li>
        <li class="{{ Request::route()->getName() == 'pengembalian.index' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('pengembalian.index') }}">
                <i class="fa fa-undo"></i> <span>Data Pengembalian</span>
            </a>
        </li>

        @if (auth()->user()->role == 'admin')
            <li class="menu-header">Data User</li>
            <li class="{{ Request::route()->getName() == 'users.index' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fa fa-user"></i> <span>Data User</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
