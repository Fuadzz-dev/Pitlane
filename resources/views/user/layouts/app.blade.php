<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PITLANE') - Racing Spirit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #ffffff;
            color: #222;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        /* Additional Global Styles */
        @yield('styles')
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <x-loadingscreen />
    
    <!-- Navbar -->
    @include('user.layouts.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('user.layouts.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>