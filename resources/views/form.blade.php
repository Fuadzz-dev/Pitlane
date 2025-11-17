<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PITLANE | Form Servis</title>
    <style>
      * {
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }

      body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: linear-gradient(145deg, #2b2b2b 0%, #424242 50%, #1c1c1c 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        color: #f4f4f4;
      }

      /* Form */
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

      button:hover {
        background: #00bcd4;
        color: #000;
        transform: scale(1.03);
        box-shadow: 0 5px 20px rgba(0, 188, 212, 0.3);
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

      @keyframes fadeOut { to { opacity: 0; visibility: hidden; } }
      @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>
  </head>
  <body>
    <!-- Form -->
    <div class="form-wrapper" id="formWrapper">
      <div class="header">
        <img src="{{ asset('images/pistons.png') }}" alt="Logo" />
        <h1>Services</h1>
      </div>
      <h2>Repair & Tune Up</h2>

      <!-- Alert Messages -->
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-error">
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-error">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('service.store') }}" method="POST">
        @csrf
        
        <label for="bengkel">Pilih Bengkel</label>
        <select id="bengkel" name="bengkel" required>
          <option value="">-- Pilih Bengkel --</option>
          @if(isset($bengkel) && count($bengkel) > 0)
            @foreach($bengkel as $item)
              <option value="{{ $item->bengkel_id }}">{{ $item->nama_bengkel }}</option>
            @endforeach
          @else
            <!-- Fallback jika database kosong -->
            <option value="1">Pitlane Garage</option>
            <option value="2">SpeedTech Motorworks</option>
            <option value="3">RPM Garage</option>
            <option value="4">TorqueZone Performance</option>
            <option value="5">PowerMax AutoWorks</option>
            <option value="6">GarageOne Racing</option>
          @endif
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
        </select>

        <label for="catatan">Catatan Tambahan</label>
        <textarea
          id="catatan"
          name="catatan"
          placeholder="Tambahkan catatan jika perlu...">{{ old('catatan') }}</textarea>

        <div class="button-group">
          <button
            type="button"
            class="back-btn"
            onclick="window.location.href='{{ route('home') }}'">
            ← Kembali ke Halaman Utama
          </button>
          <button type="submit" >Kirim Data Perbaikan</button>
        </div>
      </form>
    </div>

    <script>
      // Tampilkan form dengan animasi setelah halaman dimuat
      window.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
          document.getElementById('formWrapper').classList.add('show');
        }, 100);
      });
    </script>
  </body>
</html>