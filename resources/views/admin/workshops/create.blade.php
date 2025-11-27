@extends('admin.layouts.App')
@section('content')

<div class="form-wrapper">
    <h2 class="form-title">➕ Tambah Bengkel Baru</h2>

    <form action="{{ route('admin.workshops.store') }}" method="POST">
        @csrf

        <div class="input-group">
            <label>Nama Bengkel</label>
            <input type="text" name="nama_bengkel" placeholder="Masukkan nama bengkel" required>
        </div>

        <div class="input-group">
            <label>Alamat</label>
            <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
        </div>

        <div class="input-group">
            <label>No HP</label>
            <input type="text" name="no_hp" placeholder="08xxxxxxxxxx">
        </div>

        <div class="input-group">
            <label>Jam Operasional</label>
            <input type="text" name="jam_operasional" placeholder="Contoh: 08:00 - 17:00">
        </div>

        <div class="input-group">
            <label>Link Alamat Google Maps</label>
            <input type="text" name="link_alamat" placeholder="https://maps.google.com/...">
        </div>

        <div class="btn-area">
            <a href="{{ Route('admin.workshops.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit">Save</button>
        </div>
    </form>
</div>

@endsection

@section('styles')
<style>
/* Background full page (gradient ungu seperti gambar) */
body {
    background: linear-gradient(135deg, #5c4bff, #8c61ff);
}

/* Card kaca blur */
.form-wrapper {
    background: linear-gradient(135deg, rgba(255,255,255,0.14), rgba(255,255,255,0.08));
    padding: 45px 60px;
    border-radius: 28px;
    backdrop-filter: blur(12px);
    width: 92%;
    max-width: 1100px;
    margin: 35px auto;
    color: #fff;
}

/* Judul */
.form-title {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 40px;
}

/* Field form */
.input-group {
    margin-bottom: 28px;
}

.input-group label {
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 10px;
    display: block;
}

.input-group input,
.input-group textarea {
    width: 100%;
    padding: 18px;
    border-radius: 12px;
    border: none;
    outline: none;
    color: #fff;
    font-size: 16px;
    background: rgba(255,255,255,0.22);
    resize: none;
}

/* Button */
.btn-area {
    margin-top: 42px;
    display: flex;
    gap: 15px;
}

.btn-cancel {
    padding: 14px 36px;
    background: rgba(255,255,255,0.25);
    border-radius: 12px;
    color: #fff;
    font-size: 18px;
    font-weight: 700;
    text-decoration: none;
    transition: .25s;
}

.btn-cancel:hover {
    background: rgba(255,255,255,0.35);
}

.btn-submit {
    padding: 14px 40px;
    background: linear-gradient(135deg, #6fa8ff, #4c74ff);
    border-radius: 12px;
    border: none;
    color: #fff;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    transition: .25s;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #5b96ff, #3f63ff);
}
</style>
@endsection
