<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Perbaikan</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        background: #0f0f0f;
        color: white;
    }

    .page-title {
        margin-top: 60px;
        text-align: center;
        font-size: 40px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .back-btn {
        position: absolute;
        top: 60px;
        left: 150px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .back-btn:hover {
        background: rgba(255,255,255,0.2);
        color: #fff;
        transform: translateX(-4px);
    }

    .history-container {
        margin: 40px auto;
        width: 92%;
        max-width: 1000px;
    }

    .history-card {
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(12px);
        padding: 25px;
        margin: 20px 0;
        border-radius: 18px;
        border: 1px solid rgba(255,255,255,0.22);
        transition: 0.3s ease;
        animation: fadeIn 0.8s ease forwards;
    }

    .history-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 30px rgba(0,0,0,0.35);
    }

    .card-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .card-sub {
        opacity: 0.85;
        margin-bottom: 5px;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
    }

    .status-selesai {
        background: #4caf50;
        color: white;
    }

    .status-batal {
        background: #f44336;
        color: white;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .empty {
        text-align: center;
        font-size: 20px;
        opacity: 0.7;
        margin-top: 40px;
        padding: 40px;
        background: rgba(255,255,255,0.05);
        border-radius: 12px;
    }
</style>
</head>

<body>
    <h1 class="page-title">Riwayat Perbaikan</h1>
    <a href="{{ route('user.home') }}" class="back-btn">← Back to Home</a>

    <div class="history-container">
        @forelse($riwayat as $item)
            <div class="history-card">
                <div class="card-title">{{ $item->tipe }} ({{ $item->plat }})</div>
                <div class="card-sub">📍 Bengkel: <b>{{ $item->nama_bengkel }}</b></div>
                <div class="card-sub">🛠️ Layanan: {{ $item->nama_layanan ?? '-' }}</div>
                <div class="card-sub">👨‍🔧 Mekanik: {{ $item->nama_mekanik ?? '-' }}</div>
                <div class="card-sub">📅 Tanggal Selesai: {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y, H:i') : '-' }}</div>
                <div class="card-sub">💰 Total Biaya: Rp {{ number_format($item->total_biaya ?? 0, 0, ',', '.') }}</div>
                <div class="card-sub">📝 Keterangan: {{ $item->keterangan ?? '-' }}</div>
                <span class="status-badge status-{{ $item->status }}">
                    {{ strtoupper($item->status) }}
                </span>
            </div>
        @empty
            <div class="empty">
                <p>Belum ada riwayat perbaikan.</p>
                <small>Data riwayat akan muncul setelah servis selesai atau dibatalkan.</small>
            </div>
        @endforelse
    </div>
</body>
</html>