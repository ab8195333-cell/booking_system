<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'نظام الحجوزات') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            /* تنسيق إضافي لضمان جمال الصفحة بالعربي */
            body {
                font-family: 'figtree', 'Cairo', sans-serif;
                background-color: #f4f7f6;
            }
            .main-content {
                margin-top: 20px;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white shadow-sm border-bottom">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-right">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="main-content">
                <div class="container mt-4">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>