<style>
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
</style>

<div class="header">
    <h1>@yield('page-title', 'Dashboard Overview')</h1>
    <div class="user-info">
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
        </div>
        <div>
            <strong>{{ Auth::user()->nama }}</strong>
            <p style="font-size: 12px; color: #888;">Administrator</p>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf 
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</div>