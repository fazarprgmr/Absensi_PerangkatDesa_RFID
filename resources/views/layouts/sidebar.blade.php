<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <h5>
                <i class="bi bi-mortarboard-fill"></i>
                ABSENSI DESA
            </h5>
            <button class="sidebar-close" id="sidebarClose">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="menu-section">
            <div class="menu-section-title">DASHBOARD</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">DATA MASTER</div>
            <ul class="nav flex-column">
                <li class="nav-item">

                    @php
                        $isMaster =
                            request()->is('perangkat-desa*') || request()->is('jabatan*') || request()->is('alamat*');
                    @endphp

                    <a class="nav-link has-submenu {{ $isMaster ? 'active' : '' }}" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#masterSubmenu" aria-expanded="false">
                        <i class="bi bi-people"></i>
                        <span>Data Master</span>
                    </a>
                    <ul id="masterSubmenu" class="submenu collapse  list-unstyled {{ $isMaster ? 'show' : '' }}">
                        <li><a class="nav-link {{ request()->is('perangkat-desa*') ? 'active' : '' }}" href="{{ route('perangkat-desa.index') }}">Data Perangkat Desa</a></li>
                        <li><a class="nav-link {{ request()->is('jabatan*') ? 'active' : '' }}" href="{{ route('jabatan.index') }}">Data Jabatan</a></li>
                        <li><a class="nav-link {{ request()->is('alamat') ? 'active' : '' }}" href="{{ route('alamat.index') }}">Data Alamat</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu-section">
            <div class="menu-section-title">DATA KEHADIRAN</div>
            <ul class="nav flex-column">
                <li class="nav-item">

                    @php
                        $isKehadiran =
                            request()->is('kehadiran*') || request()->is('rekap*');
                    @endphp

                    <a class="nav-link has-submenu {{ $isKehadiran ? 'active' : '' }}" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#kehadiranSubmenu" aria-expanded="false">
                        <i class="bi bi-people"></i>
                        <span>Data Kehadiran</span>
                    </a>
                    <ul id="kehadiranSubmenu" class="submenu collapse  list-unstyled {{ $isKehadiran ? 'show' : '' }}">
                        <li><a class="nav-link {{ request()->is('kehadiran*') ? 'active' : '' }}" href="{{ route('kehadiran.index') }}">Kehadiran</a></li>
                        <li><a class="nav-link {{ request()->is('rekap*') ? 'active' : '' }}" href="{{ route('rekap.index') }}">Rekap Absensi</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</aside>
