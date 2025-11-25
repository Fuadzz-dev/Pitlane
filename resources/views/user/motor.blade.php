<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PITLANE – Motor List</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet" />

    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(135deg, #0e0e0e, #1a1a1a);
        color: #fff;
        padding-top: 70px;
      }

      /* ==== CARD MOTOR ==== */
      .motor-card {
        background: rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 20px;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);

        box-shadow: 0 8px 25px rgba(0,0,0,0.35);
        transition: all 0.35s ease;
      }

      .motor-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.5);
      }

      .motor-img {
        width: 100%;
        height: 210px;
        object-fit: contain;
        margin-bottom: 15px;
        filter: drop-shadow(0 5px 10px rgba(0,0,0,0.4));
      }

      .btn-details {
        background: linear-gradient(135deg, #0047ff, #002f9e);
        border: none;
        padding: 10px 22px;
        border-radius: 20px;
        color: white;
        font-weight: 600;
        transition: 0.3s ease;
        float: right;
      }

      .btn-details:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0,98,255,0.5);
      }

      h2.section-title {
        text-align: center;
        font-weight: 700;
        margin-bottom: 70px;
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
    </style>
  </head>
  <body>
    <!-- Title -->
    <h2 class="section-title">List Motor</h2>
    <a href="http://127.0.0.1:8000/home" class="back-btn">← Back to Home</a>

    <!-- Motor List -->
    <div class="container">
      <div class="row g-4">
        <!-- MOTORS (EXAMPLE) -->
        @foreach ($motors as $motor)
      <div class="col-md-4">
        <div class="motor-card">
          <img src="data:image/jpeg;base64,{{ base64_encode($motor->foto) }}" class="motor-img"/>
          <h4>{{ $motor->nama_kendaraan }}</h4>
          <div style="clear: both;"></div>
        </div>
      </div>
    @endforeach


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
