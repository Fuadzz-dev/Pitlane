@extends('admin.layouts.App')

@section('content')
<div class="content-section">
    <h2 style="margin-bottom: 20px;">Tambah Bengkel Baru</h2>

    <form action="{{ route('admin.workshops.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Nama Bengkel</label>
            <input type="text" name="nama_bengkel" required
                   style="width:100%; padding:12px; border-radius:10px; border:1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Alamat</label>
            <textarea name="alamat" required rows="3"
                      style="width:100%; padding:12px; border-radius:10px; border:1px solid #ccc;"></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label>No HP</label>
            <input type="text" name="no_hp"
                   style="width:100%; padding:12px; border-radius:10px; border:1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Jam Operasional</label>
            <input type="text" name="jam_operasional"
                   placeholder="Contoh: 08:00 - 17:00"
                   style="width:100%; padding:12px; border-radius:10px; border:1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Link Alamat Google Maps</label>
            <input type="text" name="link_alamat"
                   placeholder="https://maps.google.com/..."
                   style="width:100%; padding:12px; border-radius:10px; border:1px solid #ccc;">
        </div>

        <button type="submit"
                style="padding:12px 25px; background:#667eea; color:white;
                       border:none; border-radius:12px; font-weight:500;
                       box-shadow:0 4px 12px rgba(0,0,0,0.2); cursor:pointer;">
            Simpan
        </button>

        <a href="{{ Route('admin.workshops.index') }}"
           style="padding:12px 25px; background:#ccc; color:#333;
                  border-radius:12px; text-decoration:none; margin-left:10px;">
            Batal
        </a>
    </form>
</div>
@endsection
