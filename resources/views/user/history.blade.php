<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Perbaikan</title>

<!-- Poppins Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- ======= STYLE ======= -->
<style>
    body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        background: #0f0f0f;
        color: white;
    }

    /* ==== TITLE ==== */
    .page-title {
        margin-top: 60px;
        text-align: center;
        font-size: 40px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .back-btn {
        position:absolute;
        top:60px;
        left:150px;
        background:rgba(255,255,255,0.1);
        border:1px solid rgba(255,255,255,0.2);
        color:#fff;
        padding:12px 24px;
        border-radius:8px;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:8px;
        transition:all 0.3s ease;
        backdrop-filter:blur(10px);
    }
    .back-btn:hover {
        background:rgba(255,255,255,0.2);
        color:#fff;
        transform:translateX(-4px);
    }

    /* ==== HISTORY LIST ==== */
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
        transform: translateY(0);
        opacity: 0;
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

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .empty {
        text-align: center;
        font-size: 20px;
        opacity: 0.7;
        margin-top: 40px;
    }
</style>
</head>

<body>

<!-- ================= TITLE ================= -->
<h1 class="page-title">Riwayat Perbaikan</h1>
<a href="{{ Route('user.home') }}" class="back-btn">← Back to Home</a>


<!-- ================= HISTORY LIST ================= -->
<div class="history-container" id="historyList"></div>


<!-- ========== SCRIPT UNTUK AMBIL HISTORY OTOMATIS ========== -->
<script>
    // History yang dikirim dari FORM di website lain
    // Format penyimpanan:
    // localStorage.setItem("service_history", JSON.stringify(dataArray));

    function loadHistory() {
        const container = document.getElementById("historyList");
        const data = JSON.parse(localStorage.getItem("service_history")) || [];

        if (data.length === 0) {
            container.innerHTML = `<div class="empty">Belum ada riwayat perbaikan.</div>`;
            return;
        }

        data.reverse().forEach((item, index) => {
            const card = document.createElement("div");
            card.className = "history-card";
            card.style.animationDelay = `${index * 0.1}s`;

            card.innerHTML = `
                <div class="card-title">${item.judul}</div>
                <div class="card-sub">📍 Bengkel: <b>${item.bengkel}</b></div>
                <div class="card-sub">🛠️ Layanan: ${item.layanan}</div>
                <div class="card-sub">📅 Tanggal: ${item.tanggal}</div>
                <div class="card-sub">📝 Catatan: ${item.catatan}</div>
            `;

            container.appendChild(card);
        });
    }

    loadHistory();
</script>

</body>
</html>
