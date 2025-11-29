<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PITLANE | Form Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Flatpickr CSS for Date & Time Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
      * {
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }

      body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: linear-gradient(145deg, #2b2b2b 0%, #424242 50%, #1c1c1c 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        color: #f4f4f4;
      }

      .form-wrapper {
        width: 900px;
        background: #141414;
        padding: 50px 70px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
        border: 1px solid #2c2c2c;
        opacity: 0;
        transform: scale(0.95);
        transition: all 0.8s ease;
      }

      .show {
        opacity: 1;
        transform: scale(1);
      }

      .header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
      }

      .header img {
        width: 45px;
        height: 45px;
        filter: brightness(0) invert(1);
        animation: spin 8s linear infinite;
      }

      .header h1 {
        font-size: 38px;
        font-weight: 800;
        margin: 0;
      }

      h2 {
        font-size: 20px;
        font-weight: 700;
        color: #ddd;
        margin: 0 0 25px 0;
        border-bottom: 2px solid #555;
        padding-bottom: 8px;
      }

      label {
        font-size: 16px;
        color: #ccc;
        margin-bottom: 6px;
        display: block;
      }

      input, select, textarea {
        width: 100%;
        padding: 14px 12px;
        margin-bottom: 20px;
        border-radius: 6px;
        border: none;
        background: #e6e6e6;
        font-size: 15px;
        color: #000;
        transition: all 0.3s ease;
      }

      input:focus, select:focus, textarea:focus {
        background: #fff;
        outline: 2px solid #00bcd4;
        transform: scale(1.01);
      }

      textarea {
        resize: none;
        height: 70px;
      }

      /* Date Time Row */
      .datetime-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
      }

      .datetime-col {
        margin-bottom: 0;
      }

      .datetime-col input {
        margin-bottom: 0;
      }

      /* Flatpickr Custom Styling */
      .flatpickr-calendar {
        background: #1a1a1a;
        border: 1px solid #333;
        box-shadow: 0 10px 30px rgba(0,0,0,0.8);
      }

      .flatpickr-day {
        color: #fff;
      }

      .flatpickr-day.selected {
        background: #00bcd4;
        border-color: #00bcd4;
      }

      .flatpickr-day:hover {
        background: #333;
      }

      .flatpickr-months .flatpickr-month,
      .flatpickr-current-month .flatpickr-monthDropdown-months {
        background: #1a1a1a;
        color: #fff;
      }

      .flatpickr-weekday {
        color: #00bcd4;
      }

      .button-group {
        display: flex;
        justify-content: space-between;
        gap: 15px;
      }

      button {
        flex: 1;
        padding: 15px;
        background: #2a2a2a;
        color: #fff;
        font-size: 17px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
      }

      button:hover:not(:disabled) {
        background: #00bcd4;
        color: #000;
        transform: scale(1.03);
        box-shadow: 0 5px 20px rgba(0, 188, 212, 0.3);
      }

      button:disabled {
        background: #1a1a1a;
        color: #666;
        cursor: not-allowed;
        transform: none;
      }

      .back-btn {
        background: #3a3a3a;
      }

      .back-btn:hover {
        background: #666;
        color: #fff;
        transform: scale(1.03);
        box-shadow: 0 5px 20px rgba(255, 255, 255, 0.15);
      }

      .alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 15px;
        animation: slideDown 0.5s ease;
      }

      .alert-error {
        background: #b71c1c;
        color: #ef9a9a;
        border: 1px solid #c62828;
      }

      .spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,0.3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spinAnim 0.8s linear infinite;
        margin-left: 10px;
        vertical-align: middle;
      }

      .loading .spinner {
        display: inline-block;
      }

      .info-text {
        font-size: 13px;
        color: #999;
        margin-top: -15px;
        margin-bottom: 20px;
      }

      @keyframes spin { 
        from { transform: rotate(0deg); } 
        to { transform: rotate(360deg); } 
      }

      @keyframes spinAnim { 
        from { transform: rotate(0deg); } 
        to { transform: rotate(360deg); } 
      }

      @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
      }
    </style>
  </head>
  
  <body>
    <x-loadingscreen></x-loadingscreen>

    <div class="form-wrapper" id="formWrapper">
      <div class="header">
        <img src="{{ asset('images/pistons.png') }}" alt="Logo" />
        <h1>Services</h1>
      </div>
      <h2>Repair & Tune Up</h2>

      @if(session('error'))
        <div class="alert alert-error" id="alertBox">
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-error" id="alertBox">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('service.store') }}" method="POST" id="serviceForm">
        @csrf
        
        <label for="bengkel">Pilih Bengkel</label>
        <select id="bengkel" name="bengkel" required>
          <option value="">-- Pilih Bengkel --</option>
          @foreach($bengkel as $item)
            <option value="{{ $item->bengkel_id }}" {{ old('bengkel') == $item->bengkel_id ? 'selected' : '' }}>
              {{ $item->nama_bengkel }}
            </option>
          @endforeach
        </select>

        <label for="tipe">Tipe Motor</label>
        <input
          type="text"
          id="tipe"
          name="tipe"
          placeholder="Masukkan tipe motor..."
          value="{{ old('tipe') }}"
          required />

        <label for="plat">Nomor Plat</label>
        <input
          type="text"
          id="plat"
          name="plat"
          placeholder="Masukkan nomor plat..."
          value="{{ old('plat') }}"
          required />

        <label for="jenis">Jenis Perbaikan</label>
        <select id="jenis" name="jenis" required>
          <option value="">-- Pilih Jenis Perbaikan --</option>
          @foreach($layanan as $item)
            <option value="{{ $item->layanan_id }}" {{ old('jenis') == $item->layanan_id ? 'selected' : '' }}>
              {{ $item->nama_layanan }}
            </option>
          @endforeach
        </select>

        <!-- Date & Time Selection -->
        <div class="datetime-row">
          <div class="datetime-col">
            <label for="tanggal_booking">Tanggal Booking *</label>
            <input
              type="text"
              id="tanggal_booking"
              name="tanggal_booking"
              placeholder="Pilih tanggal..."
              value="{{ old('tanggal_booking') }}"
              required
              readonly />
          </div>

          <div class="datetime-col">
            <label for="jam_booking">Jam Booking *</label>
            <input
              type="text"
              id="jam_booking"
              name="jam_booking"
              placeholder="Pilih jam..."
              value="{{ old('jam_booking') }}"
              required
              readonly />
          </div>
        </div>
        <p class="info-text">* Pilih tanggal dan jam yang sesuai dengan jadwal Anda. Bengkel akan konfirmasi ketersediaan slot.</p>

        <label for="catatan">Catatan Tambahan</label>
        <textarea
          id="catatan"
          name="catatan"
          placeholder="Tambahkan catatan jika perlu...">{{ old('catatan') }}</textarea>

        <div class="button-group">
          <button
            type="button"
            class="back-btn"
            onclick="redirectToHome()">
            ← Kembali ke Halaman Utama
          </button>
          <button type="submit" id="submitBtn">
            <span id="btnText">Kirim Data Perbaikan</span>
            <span class="spinner"></span>
          </button>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    
    <script>
      // Initialize Date Picker
      flatpickr("#tanggal_booking", {
        locale: "id",
        minDate: "today",
        maxDate: new Date().fp_incr(30), // 30 days from today
        dateFormat: "Y-m-d",
        disable: [
          function(date) {
            // Disable Sundays (0)
            return (date.getDay() === 0);
          }
        ]
      });

      // Initialize Time Picker
      flatpickr("#jam_booking", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minTime: "08:00",
        maxTime: "17:00",
        minuteIncrement: 30,
        defaultHour: 9
      });

      // Show form with animation
      window.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
          document.getElementById('formWrapper').classList.add('show');
        }, 100);

        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
          setTimeout(function() {
            alertBox.style.animation = 'fadeOut 0.5s ease';
            setTimeout(function() {
              alertBox.remove();
            }, 500);
          }, 5000);
        }
      });

      // Handle form submission
      const form = document.getElementById('serviceForm');
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');

      form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        btnText.textContent = 'Mengirim...';
      });

      function redirectToHome() {
        window.location.href = "{{ route('user.home') }}";
      }
    </script>
  </body>
</html>