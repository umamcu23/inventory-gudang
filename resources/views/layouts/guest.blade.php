<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            font-family: 'Figtree', sans-serif;
        }

        .login-wrapper {
            position: relative;
            width: 100%;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            
            /* Geser form ke kanan */
            justify-content: flex-end;

            /* Jarak dari tepi kanan */
            padding: 40px 80px;

            overflow: hidden;
        }

        .login-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .login-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transform: scale(1.03);
        }

        .login-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.60);
        }

        .login-content {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 430px;
            margin-right: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 30px;
            padding: 32px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.25);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .login-content {
                max-width: 100%;
            }

            .login-card {
                padding: 24px;
                border-radius: 24px;
            }
        }
    </style>

</head>

<body>

    <div class="login-wrapper">

        <!-- Background -->
        <div class="login-bg">
            <img 
                src="{{ asset('assets/img/login-bg.jpeg') }}"
                alt="Background"
            >

            <div class="login-overlay"></div>
        </div>

        <!-- Content -->
        <div class="login-content">


            <!-- Login Card -->
            <div class="login-card">

                {{ $slot }}

            </div>

        </div>

    </div>

</body>
</html>