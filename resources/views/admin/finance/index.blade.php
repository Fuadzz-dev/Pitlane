@extends('admin.layouts.App')

@section('styles')
<style>
        /* Filter Section */
        .filter-section {
            background: rgba(255,255,255,0.95);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .filter-form {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .filter-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .filter-btn {
            padding: 10px 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .export-btn {
            background: #28a745;
        }

        .export-btn:hover {
            background: #218838;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .stat-label {
            color: #888;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-value.success {
            color: #28a745;
        }

        .stat-value.info {
            color: #17a2b8;
        }

        .stat-value.warning {
            color: #ffc107;
        }

        .stat-sub {
            font-size: 13px;
            color: #999;
        }

        /* Section Cards */
        .section-card {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        /* Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .data-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #555;
        }

        .data-table tr:hover {
            background: #f8f9fa;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .text-right {
            text-align: right;
        }

        .text-success {
            color: #28a745;
            font-weight: 600;
        }

        /* Chart container */
        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 20px;
        }
    </style>
@endsection

@section('page-title', 'Laporan Keuangan')

@section('content')

<!-- Filter Section -->
<div class="filter-section">
    <form class="filter-form">
        <div class="filter-group">
            <label>Tanggal Mulai</label>
            <input type="date" value="2025-01-01">
        </div>
        <div class="filter-group">
            <label>Tanggal Akhir</label>
            <input type="date" value="2025-02-01">
        </div>
        <button type="submit" class="filter-btn">🔍 Filter</button>
        <button class="filter-btn export-btn">📥 Export CSV</button>
    </form>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Omset</div>
        <div class="stat-value success">Rp 12.500.000</div>
        <div class="stat-sub">Periode: 01 Jan - 01 Feb</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Jumlah Servis</div>
        <div class="stat-value info">54</div>
        <div class="stat-sub">Servis selesai</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Total Komisi Mekanik</div>
        <div class="stat-value warning">Rp 2.500.000</div>
        <div class="stat-sub">20% dari omset</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Rata-rata per Servis</div>
        <div class="stat-value">Rp 230.000</div>
        <div class="stat-sub">Per transaksi</div>
    </div>
</div>

<!-- Omset per Bengkel -->
<div class="section-card">
    <h3 class="section-title">📊 Omset per Bengkel</h3>

    <table class="data-table">
        <thead>
            <tr>
                <th>Bengkel</th>
                <th class="text-right">Jumlah Servis</th>
                <th class="text-right">Total Omset</th>
                <th class="text-right">Rata-rata</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Bengkel Induk</td>
                <td class="text-right">32</td>
                <td class="text-right text-success">Rp 8.200.000</td>
                <td class="text-right">Rp 256.000</td>
            </tr>
            <tr>
                <td>Bengkel Cabang</td>
                <td class="text-right">22</td>
                <td class="text-right text-success">Rp 4.300.000</td>
                <td class="text-right">Rp 195.000</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Komisi Mekanik -->
<div class="section-card">
    <h3 class="section-title">👨‍🔧 Komisi Mekanik</h3>

    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Mekanik</th>
                <th>No. HP</th>
                <th class="text-right">Jumlah Servis</th>
                <th class="text-right">Total Pendapatan</th>
                <th class="text-right">Komisi (20%)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Rizal</td>
                <td>08123456789</td>
                <td class="text-right">18</td>
                <td class="text-right">Rp 3.000.000</td>
                <td class="text-right text-success">Rp 600.000</td>
            </tr>
            <tr>
                <td>Fikri</td>
                <td>0856123456</td>
                <td class="text-right">21</td>
                <td class="text-right">Rp 4.200.000</td>
                <td class="text-right text-success">Rp 840.000</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Grafik Omset -->
<div class="section-card">
    <h3 class="section-title">📈 Grafik Omset Harian</h3>

    <div class="chart-container">
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan'],
        datasets: [{
            label: 'Omset (Rp)',
            data: [500000, 700000, 900000, 400000, 1200000, 800000],
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
@endsection
