<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PITLANE | Form Servis</title>
    <!-- Bootstrap CSS untuk Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

      /* Success Modal Styles */
      .modal-content {
        background: #141414;
        border: 2px solid #00bcd4;
      }

      .success-checkmark {
        width: 80px;
        height: 80px;
        margin: 0 auto;
      }

      .success-checkmark .check-icon {
        width: 80px;
        height: 80px;
        position: relative;
        border-radius: 50%;
        box-sizing: content-box;
        border: 4px solid #4CAF50;
      }

      .success-checkmark .check-icon::before {
        top: 3px;
        left: -2px;
        width: 30px;
        transform-origin: 100% 50%;
        border-radius: 100px 0 0 100px;
      }

      .success-checkmark .check-icon::after {
        top: 0;
        left: 30px;
        width: 60px;
        transform-origin: 0 50%;
        border-radius: 0 100px 100px 0;
        animation: rotate-circle 4.25s ease-in;
      }

      .success-checkmark .check-icon::before, 
      .success-checkmark .check-icon::after {
        content: '';
        height: 100px;
        position: absolute;
        background: #141414;
        transform: rotate(-45deg);
      }

      .success-checkmark .check-icon .icon-line {
        height: 5px;
        background-color: #4CAF50;
        display: block;
        border-radius: 2px;
        position: absolute;
        z-index: 10;
      }

      .success-checkmark .check-icon .icon-line.line-tip {
        top: 46px;
        left: 14px;
        width: 25px;
        transform: rotate(45deg);
        animation: icon-line-tip 0.75s;
      }

      .success-checkmark .check-icon .icon-line.line-long {
        top: 38px;
        right: 8px;
        width: 47px;
        transform: rotate(-45deg);
        animation: icon-line-long 0.75s;
      }

      .success-checkmark .check-icon .icon-circle {
        top: -4px;
        left: -4px;
        z-index: 10;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        position: absolute;
        box-sizing: content-box;
        border: 4px solid rgba(76, 175, 80, .5);
      }

      .success-checkmark .check-icon .icon-fix {
        top: 8px;
        width: 5px;
        left: 26px;
        z-index: 1;
        height: 85px;
        position: absolute;
        transform: rotate(-45deg);
        background-color: #141414;
      }

      @keyframes rotate-circle {
        0% { transform: rotate(-45deg); }
        5% { transform: rotate(-45deg); }
        12% { transform: rotate(-405deg); }
        100% { transform: rotate(-405deg); }
      }

      @keyframes icon-line-tip {
        0% { width: 0; left: 1px; top: 19px; }
        54% { width: 0; left: 1px; top: 19px; }
        70% { width: 50px; left: -8px; top: 37px; }
        84% { width: 17px; left: 21px; top: 48px; }
        100% { width: 25px; left: 14px; top: 45px; }
      }

      @keyframes icon-line-long {
        0% { width: 0; right: 46px; top: 54px; }
        65% { width: 0; right: 46px; top: 54px; }
        84% { width: 55px; right: 0px; top: 35px; }
        100% { width: 47px; right: 8px; top: 38px; }
      }

      @keyframes fadeOut { 
        to { opacity: 0; visibility: hidden; } 
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
    
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center p-5">
            <!-- Success Animation -->
            <div class="success-checkmark mb-4">
              <div class="check-icon">
                <span class="icon-line line-tip"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
              </div>
            </div>
            
            <h3 class="text-success mb-3">Pendaftaran Berhasil!</h3>
            <p class="mb-2 text-white">Data servis Anda telah tersimpan</p>
            <h2 class="display-5 fw-bold mb-3" style="color: #00bcd4;" id="queueNumber"></h2>
            <p class="text-muted mb-4">Simpan nomor antrian untuk referensi</p>
            
            <button type="button" class="btn btn-lg px-5" style="background: #00bcd4; color: #000; font-weight: 600;" onclick="redirectToHome()">
              OK, Mengerti
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Form -->
    <div class="form-wrapper" id="formWrapper">
      <div class="header">
        <img src="{{ asset('images/pistons.png') }}" alt="Logo" />
        <h1>Services</h1>
      </div>
      <h2>Repair & Tune Up</h2>

      <!-- Alert Messages -->
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
        {{-- <label for="jenis">Jenis Perbaikan</label>
        <select id="jenis" name="jenis" required>
          <option value="">-- Pilih Jenis Perbaikan --</option>
          <option value="Servis rutin" {{ old('jenis') == 'Servis rutin' ? 'selected' : '' }}>Servis rutin</option>
          <option value="Ganti oli" {{ old('jenis') == 'Ganti oli' ? 'selected' : '' }}>Ganti oli</option>
          <option value="Ganti part mesin" {{ old('jenis') == 'Ganti part mesin' ? 'selected' : '' }}>Ganti part mesin</option>
          <option value="Tune up" {{ old('jenis') == 'Tune up' ? 'selected' : '' }}>Tune up</option>
          <option value="Remap ECU" {{ old('jenis') == 'Remap ECU' ? 'selected' : '' }}>Remap ECU</option>
          <option value="Bore up" {{ old('jenis') == 'Bore up' ? 'selected' : '' }}>Bore up</option>
          <option value="Upgrade CVT" {{ old('jenis') == 'Upgrade CVT' ? 'selected' : '' }}>Upgrade CVT</option>
          <option value="Porting polish" {{ old('jenis') == 'Porting polish' ? 'selected' : '' }}>Porting polish</option>
          <option value="Overhaul mesin" {{ old('jenis') == 'Overhaul mesin' ? 'selected' : '' }}>Overhaul mesin</option>
          <option value="Servis rem" {{ old('jenis') == 'Servis rem' ? 'selected' : '' }}>Servis rem</option>
          <option value="Ganti kampas kopling" {{ old('jenis') == 'Ganti kampas kopling' ? 'selected' : '' }}>Ganti kampas kopling</option>
          <option value="Servis suspensi" {{ old('jenis') == 'Servis suspensi' ? 'selected' : '' }}>Servis suspensi</option>
          <option value="Ganti aki" {{ old('jenis') == 'Ganti aki' ? 'selected' : '' }}>Ganti aki</option>
          <option value="Servis kelistrikan" {{ old('jenis') == 'Servis kelistrikan' ? 'selected' : '' }}>Servis kelistrikan</option>
          <option value="Servis karburator / injeksi" {{ old('jenis') == 'Servis karburator / injeksi' ? 'selected' : '' }}>Servis karburator / injeksi</option>
          <option value="Pengecekan dyno test" {{ old('jenis') == 'Pengecekan dyno test' ? 'selected' : '' }}>Pengecekan dyno test</option>
        </select> --}}

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
      // Tampilkan form dengan animasi
      window.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
          document.getElementById('formWrapper').classList.add('show');
        }, 100);

        // Auto hide alert after 5 seconds
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
          setTimeout(function() {
            alertBox.style.animation = 'fadeOut 0.5s ease';
            setTimeout(function() {
              alertBox.remove();
            }, 500);
          }, 5000);
        }

        // Check if success message exists (from session)
        @if(session('success'))
          // Extract queue number from success message
          const successMsg = "{{ session('success') }}";
          const queueMatch = successMsg.match(/#(\d+)/);
          if (queueMatch) {
            document.getElementById('queueNumber').textContent = '#' + queueMatch[1];
          }
          
          // Show modal
          var successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show();
        @endif
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

      // Redirect function
      function redirectToHome() {
        window.location.href = "{{ Route('user.home') }}";
      }

      // Auto redirect when modal is closed
      document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
        redirectToHome();
      });
    </script>
  </body>
</html>