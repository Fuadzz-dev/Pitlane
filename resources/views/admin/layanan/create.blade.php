@extends('admin.layouts.App')
@section('content')

<div class="form-wrapper">
    <h2 class="form-title">➕ Tambah Layanan</h2>

    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf
        
        <div class="input-group">
            <label>Nama Layanan</label>
            <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}" placeholder="Masukkan nama layanan" required>
            @error('nama_layanan') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="input-group">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" placeholder="Masukkan harga layanan" required>
            @error('harga') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="btn-area">
            <a href="{{ route('admin.layanan.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit">Save</button>
        </div>

    </form>
</div>

@endsection

@section('styles')
<style>
/* background full page */
body {
    background: linear-gradient(135deg, #5b4bff, #915aff);
}

/* container glass */
.form-wrapper {
    background: linear-gradient(135deg, rgba(255,255,255,0.12), rgba(255,255,255,0.06));
    padding: 40px 55px;
    border-radius: 28px;
    backdrop-filter: blur(12px);
    width: 90%;
    max-width: 1050px;
    margin: 35px auto;
    color: #fff;
}

/* title */
.form-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 35px;
}

/* form input */
.input-group {
    margin-bottom: 30px;
}

.input-group label {
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 10px;
    display: block;
}

.input-group input {
    width: 100%;
    padding: 18px;
    border-radius: 12px;
    border: none;
    background: rgba(255,255,255,0.22);
    outline: none;
    color: #fff;
    font-size: 16px;
}

.error {
    color: #ff7b7b;
    font-size: 13px;
}

/* button area */
.btn-area {
    margin-top: 40px;
    display: flex;
    gap: 18px;
}

.btn-cancel {
    background: rgba(255,255,255,0.25);
    padding: 14px 32px;
    border-radius: 12px;
    color: #fff;
    font-size: 18px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s;
}

.btn-cancel:hover {
    background: rgba(255,255,255,0.35);
}

.btn-submit {
    padding: 14px 36px;
    background: linear-gradient(135deg, #6fa8ff, #517bff);
    border-radius: 12px;
    border: none;
    color: #fff;
    cursor: pointer;
    font-weight: 700;
    font-size: 18px;
    transition: .25s;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #5a94ff, #4066ff);
}
</style>
@endsection
