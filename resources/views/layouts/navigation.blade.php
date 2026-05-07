<nav class="navbar top-navbar">
    <div class="container-fluid d-flex align-items-center h-100">
        <!-- Hamburger Menu -->
        <button class="hamburger-menu" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <!-- Logo for mobile -->
        <div class="navbar-brand d-lg-none fw-bold me-auto">Kiaalap</div>

        <!-- Spacer for desktop -->
        <div class="flex-grow-1 d-none d-lg-block"></div>

        <!-- Right Actions -->
        <div class="d-flex align-items-center gap-2">


            <!-- Quick Actions -->
            <div class="dropdown">
                <button class="btn btn-light btn-icon" data-bs-toggle="dropdown">
                    <i class="bi bi-plus-lg"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="add-student.html"><i class="bi bi-person-plus me-2"></i>Tambah
                            Perangkat Desa</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-calendar-plus me-2"></i>Laporan
                            Absensi</a></li>
                </ul>
            </div>

            <!-- User Menu -->
            <div class="dropdown">
                <button class="btn btn-light d-flex align-items-center" data-bs-toggle="dropdown">
                    <div class="user-avatar me-2">
                        <img src="{{ asset('template/images/user.png') }}" alt="Sarah Johnson" class="rounded-circle"
                            width="32" height="32">
                    </div>
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    <i class="bi bi-chevron-down ms-1"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                class="bi bi-person me-2"></i>Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="bi bi-box-arrow-right me-2"></i> Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
