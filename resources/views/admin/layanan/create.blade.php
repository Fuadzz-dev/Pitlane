@extends('admin.layouts.App')

@section('title', 'Tambah Layanan')
@section('page-title', 'Tambah Layanan')

@section('content')

<div class="form-container">
    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf
        
        <div class="input-group">
            <label>Nama Layanan</label>
            <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}" required>
            @error('nama_layanan') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="input-group">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" required>
            @error('harga') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="btn-area">
            <a href="{{ route('admin.services.index') }}" class="btn-cancel">Kembali</a>
            <button type="submit" class="btn-submit">Simpan</button>
        </div>

    </form>
</div>

@endsection

@section('styles')
<style>
.form-container {
    padding: 25px;
    background: rgba(255,255,255,0.06);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    width: 100%;
    max-width: 550px;
    margin: auto;
}

.input-group {
    margin-bottom: 18px;
}

.input-group label {
    color: #fff;
    font-size: 15px;
    font-weight: 600;
}

.input-group input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    margin-top: 6px;
    background: rgba(255,255,255,0.12);
    color: #fff;
    font-size: 14px;
}

.error {
    color: #ff7b7b;
    font-size: 12px;
}

.btn-area {
    margin-top: 25px;
    display: flex;
    justify-content: space-between;
}

.btn-submit {
    padding: 10px 28px;
    background: linear-gradient(135deg, #6fa8ff, #517bff);
    border: none;
    color: #fff;
    font-weight: 600;
    border-radius: 10px;
    cursor: pointer;
    transition: .25s;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #5a94ff, #4066ff);
}

.btn-cancel {
    padding: 10px 28px;
    border-radius: 10px;
    border: 2px solid #6fa8ff;
    color: #fff;
    font-weight: 600;
    transition: .25s;
}

.btn-cancel:hover {
    background: rgba(255,255,255,0.12);
}
</style>
@endsection
