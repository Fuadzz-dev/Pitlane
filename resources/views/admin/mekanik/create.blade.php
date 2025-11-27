@extends('admin.layout.app')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .form-container h2 {
        font-size: 22px;
        margin-bottom: 20px;
        font-weight: bold;
        color: #333;
    }
    .form-group {
        margin-bottom: 18px;
    }
    label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #444;
    }
    input, select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
    }
    input:focus, select:focus {
        border-color: #0055ff;
        outline: none;
    }
    .btn-submit {
        width: 100%;
        background: #0055ff;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-submit:hover {
        background: #003fcc;
    }
    .btn-back {
        display: inline-block;
        margin-bottom: 15px;
        text-decoration: none;
        font-size: 14px;
        color: #0055ff;
    }
</style>

<div class="form-container">

    <a href="{{ route('admin.mekanik.index') }}" class="btn-back">← Kembali ke daftar mekanik</a>

    <h2>➕ Tambah Mekanik</h2>

    @if ($errors->any())
        <div style="background:#ffe5e5; padding:10px; border-radius:6px; margin-bottom:15px;">
            <ul style="margin:0; padding-left:18px; color:#d20000;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mekanik.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Mekanik</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama mekanik" required>
        </div>

        <div class="form-group">
            <label>Nomor HP</label>
            <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="form-group">
            <label>Pilih Bengkel</label>
            <select name="workshop_id" required>
                <option value="">-- Pilih Bengkel --</option>
                @foreach ($workshops as $workshop)
                    <option value="{{ $workshop->id }}">{{ $workshop->nama_bengkel }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-submit">Simpan Mekanik</button>
    </form>
</div>
@endsection
