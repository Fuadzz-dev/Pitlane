<div class="sidebar">
    <div class="logo-section">
        <h2>⚙️ PITLANE</h2>
        <p style="color: #888; font-size: 12px; margin-top: 5px;">Admin Panel</p>
    </div>
    
    <a href="{{ Route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        📊 Dashboard
    </a>
    
    <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        👥 Users
    </a>
    
    <a href="{{ route('admin.motorcycles.index') }}" class="menu-item {{ request()->routeIs('admin.motorcycles.*') ? 'active' : '' }}">
        🏍️ Motorcycles
    </a>
    
    <a href="{{ route('admin.layanan.index') }}" class="menu-item {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
        🔧 Layanan
    </a>
    
    <a href="{{ route('admin.workshops.index') }}" class="menu-item {{ request()->routeIs('admin.workshops.*') ? 'active' : '' }}">
        🏪 Workshops
    </a>

    <a href="{{ Route('admin.mekanik.index') }}" class="menu-item {{ request()->routeIs('admin.mekanik.*') ? 'active' : '' }}">
        📜 Mechanic
    </a>

    
    <a href="{{ route('admin.queue.index') }}" class="menu-item {{ request()->routeIs('admin.queue.*') ? 'active' : '' }}">
        📋 Queue Management
    </a>
    
    <a href="{{ route('admin.settings') }}" class="menu-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
        ⚙️ Settings
    </a>
</div>