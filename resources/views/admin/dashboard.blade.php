@extends('admin.layouts.App')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

<style>
    /* 🎨 Card Custom Design */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 25px;
        margin-bottom: 35px;
    }

    .stat-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.08));
        backdrop-filter: blur(18px);
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        border: 1px solid rgba(255,255,255,0.3);
        transition: 0.3s ease;
        animation: fadeIn 0.6s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.18);
    }

    .stat-card h3 {
        font-size: 15px;
        color: #ffffff;
        font-weight: 500;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .stat-number {
        font-size: 42px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 10px;
        text-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .stat-label {
        font-size: 13px;
        color: #dfe4ff;
    }

    /* Optional icon */
    .icon-badge {
        width: 50px;
        height: 50px;
        background: rgba(255,255,255,0.3);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 15px;
        color: white;
    }

    /* Fade animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Table container */
.table-container {
    overflow-x: auto;
}

/* Table styling */
.recent-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Poppins', sans-serif;
}

.recent-table th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px;
    text-align: left;
    font-weight: 500;
}

.recent-table td {
    padding: 15px;
    border-bottom: 1px solid #f0f0f0;
    color: #ffffff;
}

.recent-table tr:hover {
    background: #00000015;
    transition: 0.2s ease;
}

/* Status badges */
.status-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
}

.status-badge.pending {
    background: #fff3cd;
    color: #856404;
}

.status-badge.processing {
    background: #d1ecf1;
    color: #0c5460;
}
</style>

<!-- ⭐ Stats Section (NEW) -->
<div class="stats-grid">
<!-- TOTAL USERS -->
<div class="stat-card">
    <div class="icon-badge">👥</div>
    <h3>TOTAL USERS</h3>
    <div class="stat-number">{{ $totalUsers }}</div>
</div>

<!-- ACTIVE SERVICES -->
<div class="stat-card">
    <div class="icon-badge">🔧</div>
    <h3>ACTIVE SERVICES</h3>
    <div class="stat-number">{{ $activeServices }}</div>
</div>

<!-- TOTAL HISTORY SERVICES -->
<div class="stat-card">
    <div class="icon-badge">📚</div>
    <h3>TOTAL SERVIS SELESAI</h3>
    <div class="stat-number">{{ $totalServis }}</div>
</div>


<!-- WORKSHOPS -->
<div class="stat-card">
    <div class="icon-badge">🏪</div>
    <h3>REGISTERED WORKSHOPS</h3>
    <div class="stat-number">{{ $totalWorkshops }}</div>    
</div>

</div>

<!-- Recent Activity -->
<div class="content-section">
    <h2>Recent Service Bookings</h2>

    <div class="table-container">
        <table class="recent-table">
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
                @foreach ($recent_queues as $queue)
                <tr>
                    <td>#{{ $queue->antrian_id }}</td>
                    <td>{{ $queue->user_name }}</td>
                    <td>{{ $queue->service_type  }}</td>
                    <td>{{ $queue->tanggal_pemesanan }}</td>
                    <td>
                        @if($queue->status == 'menunggu')
                            <span class="status-badge pending">Menunggu</span>
                        @elseif($queue->status == 'diproses')
                            <span class="status-badge processing">Diproses</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
