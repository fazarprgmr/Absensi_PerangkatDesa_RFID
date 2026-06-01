<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>


    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        body {
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
            justify-content: center;
            min-height: 100vh
        }

        .auth-container {
            max-width: 420px;
            padding: 20px;
            width: 100%
        }

        .auth-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .1);
            padding: 40px
        }

        .auth-header {
            margin-bottom: 30px;
            text-align: center
        }

        .brand-logo {
            align-items: center;
            background: #6366f1;
            border-radius: 12px;
            display: inline-flex;
            height: 60px;
            justify-content: center;
            margin-bottom: 20px;
            width: 60px
        }

        .brand-logo i {
            color: #fff;
            font-size: 30px
        }
    </style>
    <link rel="stylesheet" crossorigin href="{{ asset('template/assets/bootstrap-icons-B8n0W9AC.css') }}">
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            @yield('content')
        </div>
        <div class="text-center mt-4">
            <p class="text-white-50 small">
                &copy; 2026 Sistem Absensi Perangkat Desa | v1.0. All rights reserved. |
            </p>
        </div>
    </div>

</body>

</html>
