<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteSettings['site_title']->value ?? 'Tierra Groove Festival' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .bg-image-cover {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .bg-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }
        .content-over-overlay {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body class="antialiased bg-gray-900 text-white">

    <!-- Header -->
    @include('layouts.partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

</body>
</html> 