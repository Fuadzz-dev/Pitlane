<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - PITLANE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px 20px;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .logo-section h2 {
            color: #333;
            font-size: 24px;
            margin-top: 10px;
        }

        .menu-item {
            padding: 15px 20px;
            margin: 10px 0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #555;
            font-weight: 500;
            text-decoration: none;
            display: block;
        }

        .menu-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }

        .menu-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px;
        }

        /* Additional styles */
        @yield('styles')
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('admin.layouts.Sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @include('admin.layouts.Header')
            
            <!-- Content Area -->
            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>