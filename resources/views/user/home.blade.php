<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PITLANE - Racing Spirit</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet" />
    <style>
        body {
          font-family: "Poppins", sans-serif;
          background-color: #ffffff;
          color: #222;
          margin: 0;
          padding: 0;
          scroll-behavior: smooth;
        }

        /* ==== HERO ==== */
        .hero {
          position: relative;
          height: 100vh;
          overflow: hidden;
          margin: 0;
          padding: 0;
        }

        .hero img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          display: block;
        }

        /* ==== ABOUT ==== */
        #about {
          padding: 100px 0;
          background-color: #5b5b5b;
        }

        .about-title {
          font-size: 2.6rem;
          font-weight: 700;
          color: #111;
          margin-bottom: 25px;
        }

        .about-text {
          font-size: 1.1rem;
          color: #000000;
          line-height: 1.8;
          margin-bottom: 30px;
        }

        .btn-learn {
          display: inline-block;
          border: 2px solid #000;
          color: #000;
          padding: 12px 28px;
          border-radius: 50px;
          text-decoration: none;
          font-weight: 600;
          transition: all 0.3s ease;
        }

        .btn-learn:hover {
          background-color: #000;
          color: #fff;
        }

        .about-img img {
          width: 100%;
          max-width: 550px;
          border-radius: 12px;
          box-shadow: 0 8px 25px rgba(0,0,0,0.15);
          transition: transform 0.5s ease;
        }

        .about-img img:hover {
          transform: scale(1.03);
        }

        /* ==== FORM SECTION (KARTU ANIMASI) ==== */
        #form {
          background: linear-gradient(135deg, #000000, #222222);
        }

        .py-5{
          padding-top: 4rem !important;
          padding-bottom: 4rem !important;
        }

        #form h2 {
          color: white;
          font-weight: 700;
          text-align: left;
          margin-left: 110px;
          margin-bottom: 60px;
          font-size: 2.5rem;
        }

        .service-card {
          position: relative;
          height: 320px;
          border-radius: 12px;
          background-size: cover;
          background-position: center;
          overflow: hidden;
          cursor: pointer;
          transition: transform 0.4s ease, box-shadow 0.4s ease;
          animation: fadeUp 1s ease both;
        }

        .service-card:hover {
          transform: scale(1.05);
          box-shadow: 0 12px 25px rgba(0,0,0,0.5);
        }

        .service-card:active {
          transform: scale(0.98);
          box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        .service-card .overlay {
          position: absolute;
          inset: 0;
          background: rgba(0,0,0,0.45);
          transition: background 0.4s ease;
        }

        .service-card:hover .overlay {
          background: rgba(0,0,0,0.65);
        }

        .service-card h3 {
          position: absolute;
          bottom: 20px;
          left: 25px;
          color: #fff;
          font-weight: 700;
          font-size: 1.8rem;
          letter-spacing: 1px;
          z-index: 2;
          animation: fadeUp 0.8s ease;
        }

        @keyframes fadeUp {
          from {
            transform: translateY(20px);
            opacity: 0;
          }
          to {
            transform: translateY(0);
            opacity: 1;
          }
        }

        /* ==== START SERVICE ==== */
        #start-service {
          background: linear-gradient(135deg, #111 0%, #1c1c1c 100%);
          color: #fff;
          padding: 120px 0;
        }

        #start-service h2 {
          font-size: 2.5rem;
          font-weight: 700;
          margin-bottom: 40px;
          text-align: center;
        }

        .queue-box {
          background: rgba(255, 255, 255, 0.08);
          border-radius: 15px;
          padding: 30px;
          max-width: 900px;
          margin: 0 auto;
          box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
          backdrop-filter: blur(6px);
          animation: fadeIn 1.2s ease;
        }

        .queue-item {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 15px 25px;
          border-bottom: 1px solid rgba(255, 255, 255, 0.1);
          font-size: 1rem;
        }

        .queue-item:last-child {
          border-bottom: none;
        }

        .queue-item span {
          color: #3aabdc;
          font-weight: 600;
        }

        @keyframes fadeIn {
          from { opacity: 0; transform: translateY(25px); }
          to { opacity: 1; transform: translateY(0); }
        }

        /* ==== CONTACT & FOOTER ==== */
        #contact {
          padding: 100px 0;
          background-color: #5b5b5b;
        }

        footer {
          background-color: #222;
          color: white;
          text-align: center;
          padding: 25px 0;
          font-size: 0.9rem;
        }

        footer a {
          color: #59B9F4;
          text-decoration: none;
        }
    </style>
  </head>
  <body>
      <x-loadingscreen></x-loadingscreen>
      <x-navbar></x-navbar>

    <!-- Hero -->
    <section class="hero" id="hero">
      <img src="{{ asset('img/Untitled-12.png') }}" alt="Pitlane Hero Image" />
    </section>

    <!-- About -->
    <section id="about">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h2 class="about-title">About PITLANE</h2>
            <p class="about-text">
              PITLANE is a modern motorcycle workshop dedicated to delivering
              quality, precision, and speed in every service. We combine expert
              craftsmanship with advanced technology to ensure your bike
              performs at its best. Our mission is to provide reliable
              maintenance and performance upgrades that keep every ride safe,
              powerful, and full of spirit.
            </p>
            <a href="#start-service" class="btn-learn">Read More →</a>
          </div>
          <div class="col-lg-6 text-center about-img">
            <img src="{{ asset('img/Untitled-13.png') }}" alt="About PITLANE" />
          </div>
        </div>
      </div>
    </section>

    <!-- Form Input Servis (Kartu Animasi Bisa Diklik) -->
    <section id="form" class="py-5">
      <div class="container">
        <h2>Layanan</h2>
        <div class="row g-4 justify-content-center">
          <div class="col-md-5 col-lg-5">
            <a href="{{ Route('history') }}" class="text-decoration-none">
              <div class="service-card" style="background-image: url('{{ asset('img/1.jpg') }}');">
                <div class="overlay"></div>
                <h3>HISTORY</h3>
              </div>
            </a>
          </div>

          <div class="col-md-5 col-lg-5">
            <a href="{{ route('service') }}" class="text-decoration-none">
              <div class="service-card" style="background-image: url('{{ asset('img/2.jpg') }}');">
                <div class="overlay"></div>
                <h3>SERVICE</h3>
              </div>
            </a>
          </div>

          <div class="col-md-5 col-lg-5">
            <a href="{{ route('motor') }}" class="text-decoration-none">
              <div class="service-card" style="background-image: url('{{ asset('img/3.jpg') }}');">
                <div class="overlay"></div>
                <h3>MOTOR</h3>
              </div>
            </a>
          </div>

          <div class="col-md-5 col-lg-5">
            <a href="{{ route('bengkel') }}" class="text-decoration-none">
              <div class="service-card" style="background-image: url('{{ asset('img/4.jpg') }}');">
                <div class="overlay"></div>
                <h3>BENGKEL</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Start Service -->
    <section id="start-service">
      <div class="container">
        <h2>Service Queue</h2>
        <div class="queue-box">
          <div id="queueList">
  @forelse ($queues as $q)
    <div class="queue-item">
      <span>#{{ $q->antrian_id }}</span>
      {{ $q->tipe }} — {{ $q->plat }}
      <span style="font-weight: 700; color: {{ $q->status == 'diproses' ? '#3aabdc' : '#ffc107' }};">
        ({{ strtoupper($q->status) }})
      </span>
    </div>
  @empty
    <div class="queue-item text-center">
      Belum ada antrian berjalan
    </div>
  @endforelse
</div>  
        </div>
      </div>
    </section>

    <!-- Contact -->
    <section id="contact">
      <div class="container text-center">
        <h2 class="mb-4">Contact Us</h2>
        <p>For questions or service booking, reach us at:</p>
        <a href="mailto:pitlane.racing@gmail.com" class="btn btn-dark mt-3">
          Email Us
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <p>
        ©2025 PITLANE Workshop. All Rights Reserved. | Designed By Duta & Ucu &
        Fuad
      </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
