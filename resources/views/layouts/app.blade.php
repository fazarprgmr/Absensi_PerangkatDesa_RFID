<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kiaalap - Modern Education Management Dashboard for Universities">
    <meta name="keywords" content="education, dashboard, university, management, admin">
    <meta name="author" content="Kiaalap">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
    <link rel="preconnect" href="https://ui-avatars.com" crossorigin>
    <link rel="dns-prefetch" href="https://flagcdn.com">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/favicon-9EIT7vLh.ico') }}">


    <!-- Load stylesheets -->



    <!-- Diagnostic inline styles - maximum specificity -->
    <style>
        .sidebar.collapsed {
            max-width: 70px !important;
            min-width: 70px !important;
            width: 70px !important
        }

        .sidebar.collapsed .sidebar-brand h5 {
            font-size: 0 !important
        }

        .sidebar.collapsed .nav-link span {
            display: none !important
        }

        /* default: hamburger tampil (mobile) */
        .hamburger-menu {
            display: inline-block;
        }

        /* desktop: sembunyikan */
        @media (min-width: 992px) {
            .hamburger-menu {
                display: none;
            }
        }

        @media (min-width: 992px) {
            .sidebar {
                left: 0 !important;
                position: relative;
            }

            .sidebar-overlay {
                display: none !important;
            }
        }
    </style>

    <script type="module" crossorigin src="{{ asset('template/assets/main-COwrHBJ0.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('template/assets/dashboard-hMfJATH4.css') }}">

    @stack('styles')

</head>

<body>
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>

    <!-- Required DOM elements for dashboard.js -->
    <div class="search-backdrop" id="searchBackdrop"></div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- Main Content Wrapper -->
    <div class="main-wrapper" id="mainWrapper">
        <!-- Header -->
        @include('layouts.navigation')
        <!-- Main Content -->
        <main class="dashboard-content" id="main-content">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <!-- Load JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 2000,
                showConfirmButton: true,
                confirmButtonText: "OKE",
                timerProgressBar: true,
            });
        </script>
    @endif

    @stack('scripts')

</body>

</html>
