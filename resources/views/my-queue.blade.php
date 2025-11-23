<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PITLANE | Antrian Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(145deg, #2b2b2b 0%, #424242 50%, #1c1c1c 100%);
            min-height: 100vh;
            color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: #141414;
            border-radius: 12px;
            border: 1px solid #2c2c2c;
        }

        .page-header h1 {
            font-size: 32px;
            font-weight: 800;
            color: #00bcd4;
        }

        .page-header p {
            color: #aaa;
            margin-top: 5px;
        }

        .btn {
            padding: 12px 25px;
            background: #00bcd4;
            color: #000;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(0, 188, 212, 0.4);
        }

        .btn-secondary {
            background: #3a3a3a;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #555;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .alert-success {
            background: #1b5e20;
            color: #a5d6a7;
            border: 1px solid #2e7d32;
        }

        .alert-error {
            background: #b71c1c;
            color: #ef9a9a;
            border: 1px solid #c62828;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #141414;
            border-radius: 12px;
            border: 2px dashed #333;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            fill: #555;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: #888;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 30px;
        }

        /* Queue Grid */
        .queue-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        /* Queue Card */
        .queue-card {
            background: #141414;
            border: 1px solid #2c2c2c;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .queue-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 188, 212, 0.2);
            border-color: #00bcd4;
        }

        .card-header {
            padding: 20px;
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            border-bottom: 1px solid #333;
        }

        .card-header-top {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 10px;
        }

        .queue-number {
            font-size: 14px;
            color: #888;
        }

        .bengkel-name {
            font-size: 20px;
            font-weight: 700;
            color: #00bcd4;
            margin: 5px 0;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-menunggu {
            background: #f57c00;
            color: #fff;
        }

        .status-diproses {
            background: #1976d2;
            color: #fff;
        }

        .status-selesai {
            background: #388e3c;
            color: #fff;
        }

        .status-dibatalkan {
            background: #d32f2f;
            color: #fff;
        }

        .card-body {
            padding: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #222;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #888;
            font-size: 14px;
        }

        .info-value {
            font-weight: 600;
            color: #fff;
            text-align: right;
        }

        .plat-number {
            text-transform: uppercase;
            color: #00bcd4;
        }

        .card-footer {
            padding: 15px 20px;
            background: #0a0a0a;
            border-top: 1px solid #222;
            text-align: center;
        }

        .card-footer small {
            color: #666;
            font-size: 12px;
        }

        /* Back Button */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #00bcd4;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            gap: 12px;
            color: #fff;
        }

        @media (max-width: 768px) {
            .queue-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Back Link -->
        <a href="{{ route('home') }}" class="back-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            </svg>
            Kembali ke Beranda
        </a>

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Antrian Saya</h1>
                <p>Daftar servis motor yang telah Anda daftarkan</p>
            </div>
            <a href="{{ route('service.create') }}" class="btn">
                + Daftar Servis Baru
            </a>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ✗ {{ session('error') }}
            </div>
        @endif

        <!-- Content -->
        @if($antrians->isEmpty())
            <!-- Empty State -->
            <div class="empty-state">
                <svg viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                </svg>
                <h3>Belum Ada Antrian</h3>
                <p>Anda belum mendaftarkan servis motor.<br>Mulai daftarkan sekarang untuk mendapatkan layanan terbaik!</p>
                <a href="{{ route('service.create') }}" class="btn">
                    Daftar Servis Sekarang
                </a>
            </div>
        @else
            <!-- Queue Grid -->
            <div class="queue-grid">
                @foreach($antrians as $antrian)
                    <div class="queue-card">
                        <!-- Card Header -->
                        <div class="card-header">
                            <div class="card-header-top">
                                <div>
                                    <div class="queue-number">Antrian #{{ $antrian->antrian_id }}</div>
                                    <div class="bengkel-name">{{ $antrian->nama_bengkel }}</div>
                                </div>
                                <span class="status-badge status-{{ $antrian->status }}">
                                    {{ ucfirst($antrian->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="info-row">
                                <span class="info-label">Tipe Motor</span>
                                <span class="info-value">{{ $antrian->tipe }}</span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Nomor Plat</span>
                                <span class="info-value plat-number">{{ $antrian->plat }}</span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Tanggal Pemesanan</span>
                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($antrian->tanggal_pemesanan)->format('d M Y, H:i') }}
                                </span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Tanggal Servis</span>
                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($antrian->tanggal_servis)->format('d M Y') }}
                                </span>
                            </div>

                            @if($antrian->catatan)
                            <div class="info-row">
                                <span class="info-label">Catatan</span>
                                <span class="info-value">{{ Str::limit($antrian->catatan, 30) }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer">
                            <small>
                                Dibuat {{ \Carbon\Carbon::parse($antrian->tanggal_pemesanan)->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>