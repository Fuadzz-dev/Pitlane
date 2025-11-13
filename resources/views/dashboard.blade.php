<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PITLANE</title>
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

        .logo-section p {
            color: #888;
            font-size: 12px;
            margin-top: 5px;
        }

        .menu-item {
            padding: 15px 20px;
            margin: 10px 0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #555;
            font-weight: 500;
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

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px 40px;
            border-radius: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            font-size: 28px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .logout-btn {
            padding: 10px 25px;
            background: #ff4757;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #ff3838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card h3 {
            color: #888;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .stat-card .change {
            font-size: 14px;
            color: #2ecc71;
        }

        /* Content Section */
        .content-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .content-section h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 500;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            color: #555;
        }

        table tr:hover {
            background: #f9f9f9;
        }

        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-container {
            animation: fadeIn 0.6s ease;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo-section">
                <h2>⚙️ PITLANE</h2>
                <p>Admin Panel</p>
            </div>
            <div class="menu-item active">📊 Dashboard</div>
            <div class="menu-item">👥 Users</div>
            <div class="menu-item">🏍️ Motorcycles</div>
            <div class="menu-item">🔧 Services</div>
            <div class="menu-item">🏪 Workshops</div>
            <div class="menu-item">📸 Gallery</div>
            <div class="menu-item">⚙️ Settings</div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <h1>Dashboard Overview</h1>
                <div class="user-info">
                    <div class="user-avatar">A</div>
                    <div>
                        <strong>Admin</strong>
                        <p style="font-size: 12px; color: #888;">Administrator</p>
                    </div>
                    <form method="POST" action="/logout" style="display: inline;">
                        @csrf 
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>TOTAL USERS</h3>
                    <div class="number">1,234</div>
                    <div class="change">↑ 12% from last month</div>
                </div>
                <div class="stat-card">
                    <h3>ACTIVE SERVICES</h3>
                    <div class="number">89</div>
                    <div class="change">↑ 8% from last month</div>
                </div>
                <div class="stat-card">
                    <h3>MOTORCYCLES</h3>
                    <div class="number">456</div>
                    <div class="change">↑ 15% from last month</div>
                </div>
                <div class="stat-card">
                    <h3>WORKSHOPS</h3>
                    <div class="number">23</div>
                    <div class="change">↑ 5% from last month</div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="content-section">
                <h2>Recent Service Bookings</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Service Type</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#001</td>
                                <td>John Doe</td>
                                <td>Oil Change</td>
                                <td>2025-11-02</td>
                                <td><span class="status-badge status-active">Completed</span></td>
                            </tr>
                            <tr>
                                <td>#002</td>
                                <td>Jane Smith</td>
                                <td>Tire Replacement</td>
                                <td>2025-11-02</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>#003</td>
                                <td>Mike Johnson</td>
                                <td>Full Service</td>
                                <td>2025-11-01</td>
                                <td><span class="status-badge status-active">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>