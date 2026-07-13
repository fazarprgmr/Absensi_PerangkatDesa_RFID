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

    <title>404</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./assets/favicon-9EIT7vLh.ico">


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
    </style>

    <link rel="stylesheet" crossorigin href="{{ asset('template/assets/dashboard-hMfJATH4.css') }}">
</head>

<body>
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>

    <!-- Required DOM elements for dashboard.js -->
    <div class="search-backdrop" id="searchBackdrop"></div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <style>
        .error-page {
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative
        }

        .error-container {
            margin: 0 auto;
            max-width: 600px;
            padding: 2rem;
            text-align: center;
            z-index: 10
        }

        .error-code {
            animation: float 3s ease-in-out infinite;
            color: #fff;
            font-size: 10rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0;
            text-shadow: 3px 3px 20px rgba(0, 0, 0, .2)
        }

        @keyframes float {

            0%,
            to {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-20px)
            }
        }

        .error-title {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            margin-top: 1rem
        }

        .error-message {
            color: hsla(0, 0%, 100%, .9);
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 2rem
        }

        .error-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center
        }

        .error-btn {
            align-items: center;
            border-radius: 50px;
            display: inline-flex;
            font-size: 1rem;
            font-weight: 500;
            gap: 8px;
            padding: 12px 30px;
            text-decoration: none;
            transition: all .3s ease
        }

        .btn-home {
            background: #fff;
            border: 2px solid #fff;
            color: #667eea
        }

        .btn-home:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
            transform: translateY(-2px)
        }

        .btn-back,
        .btn-home:hover {
            background: transparent;
            color: #fff
        }

        .btn-back {
            border: 2px solid #fff
        }

        .btn-back:hover {
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
            color: #667eea;
            transform: translateY(-2px)
        }

        .bg-shape {
            opacity: .1;
            position: absolute
        }

        .shape-1 {
            animation: rotate 20s linear infinite;
            height: 400px;
            right: -200px;
            top: -200px;
            width: 400px
        }

        .shape-1,
        .shape-2 {
            background: #fff;
            border-radius: 50%
        }

        .shape-2 {
            animation: rotate 15s linear infinite reverse;
            bottom: -150px;
            height: 300px;
            left: -150px;
            width: 300px
        }

        .shape-3 {
            animation: float 5s ease-in-out infinite;
            background: #fff;
            height: 200px;
            left: 10%;
            top: 50%;
            transform: rotate(45deg);
            width: 200px
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg)
            }

            to {
                transform: rotate(1turn)
            }
        }

        @media (max-width:768px) {
            .error-code {
                font-size: 6rem
            }

            .error-title {
                font-size: 1.8rem
            }

            .error-message {
                font-size: 1rem
            }

            .error-actions {
                align-items: center;
                flex-direction: column
            }

            .error-btn {
                justify-content: center;
                width: 200px
            }
        }

        .error-search {
            margin-left: auto;
            margin-right: auto;
            margin-top: 2rem;
            max-width: 400px
        }

        .search-group {
            position: relative
        }

        .search-input {
            backdrop-filter: blur(10px);
            background: hsla(0, 0%, 100%, .2);
            border: none;
            border-radius: 50px;
            color: #fff;
            font-size: 1rem;
            padding: 12px 50px 12px 20px;
            transition: all .3s ease;
            width: 100%
        }

        .search-input::-moz-placeholder {
            color: hsla(0, 0%, 100%, .6)
        }

        .search-input::placeholder {
            color: hsla(0, 0%, 100%, .6)
        }

        .search-input:focus {
            background: hsla(0, 0%, 100%, .3);
            box-shadow: 0 5px 20px rgba(0, 0, 0, .2);
            outline: none
        }

        .search-btn {
            align-items: center;
            background: #fff;
            border: none;
            border-radius: 50%;
            color: #667eea;
            cursor: pointer;
            display: flex;
            height: 40px;
            justify-content: center;
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            transition: all .3s ease;
            width: 40px
        }

        .search-btn:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, .2);
            transform: translateY(-50%) scale(1.1)
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
            margin: 0;
            padding: 0
        }
    </style>

    <div class="error-page">
        <!-- Animated Background Shapes -->
        <div class="bg-shape shape-1"></div>
        <div class="bg-shape shape-2"></div>
        <div class="bg-shape shape-3"></div>

        <!-- Error Content -->
        <div class="error-container">
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Oops! Halaman Tidak Ditemukan</h2>
            <p class="error-message">
                Halaman yang kamu cari sepertinya menghilang.
                Bisa jadi halaman tersebut sudah dihapus, dipindahkan,
                atau memang tidak pernah ada.
            </p>

            <!-- Tombol Aksi -->
            <div class="error-actions">
                <a href="{{ route('dashboard') }}" class="error-btn btn-home">
                    <i class="bi bi-house-door"></i>
                    Kembali ke Dashboard
                </a>
                <a href="javascript:history.back()" class="error-btn btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>

            <!-- Link Bantuan -->
            <div style="margin-top: 3rem;">
                <p style="color: rgba(255,255,255,0.7); margin-bottom: 1rem;">
                    Halaman kami:
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">

                    <a href="{{ route('dashboard') }}" style="color: white; text-decoration: underline; opacity: 0.8;">
                        Dashboard
                    </a>

                    <a href="{{ route('perangkat-desa.index') }}"
                        style="color: white; text-decoration: underline; opacity: 0.8;">
                        Perangkat Desa
                    </a>

                    <a href="{{ route('jabatan.index') }}"
                        style="color: white; text-decoration: underline; opacity: 0.8;">
                        Jabatan
                    </a>

                    <a href="{{ route('kehadiran.index') }}"
                        style="color: white; text-decoration: underline; opacity: 0.8;">
                        Kehadiran
                    </a>

                </div>
            </div>

            <script>
                // Add some interactivity
                document.addEventListener('DOMContentLoaded', function() {
                    // Animate error code on page load
                    const errorCode = document.querySelector('.error-code');
                    if (errorCode) {
                        errorCode.style.opacity = '0';
                        errorCode.style.transform = 'scale(0.5)';
                        setTimeout(() => {
                            errorCode.style.transition = 'all 0.5s ease';
                            errorCode.style.opacity = '1';
                            errorCode.style.transform = 'scale(1)';
                        }, 100);
                    }

                    // Handle search form
                    const searchForm = document.querySelector('.search-group');
                    if (searchForm) {
                        searchForm.addEventListener('submit', function(e) {
                            e.preventDefault();
                            const query = this.querySelector('input').value;
                            if (query) {
                                // In a real application, this would perform a search
                                alert('Search functionality would search for: ' + query);
                            }
                        });
                    }

                    // Log 404 error for analytics (in production)
                    console.log('404 Error - Page not found:', window.location.pathname);
                });
            </script>
