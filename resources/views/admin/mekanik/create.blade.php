@extends('admin.layouts.App')

@section('content')
<style>
    .form-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 40px;
        border-radius: 20px;
        backdrop-filter: blur(14px);
        background: linear-gradient(135deg, rgba(137, 160, 255, 0.35), rgba(112, 89, 201, 0.35));
        color: #fff;
    }

    .form-container h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 25px;
        color: #ffffff;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        font-size: 16px;
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: #ffffff;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        border: none;
        border-radius: 12px;
        padding: 14px;
        background: rgba(255,255,255,0.28);
        color: #000;
        font-size: 15px;
    }

    .form-group input::placeholder {
        color: #3a3a3a;
    }

    .btn-submit {
        padding: 10px 30px;
        background: linear-gradient(135deg, #6fa8ff, #517bff);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.25s;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #5a94ff, #4066ff);
    }

    .btn-back {
        padding: 10px 30px;
        background: #cfcfcf;
        border-radius: 10px;
        border: none;
        color: #000;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: 0.25s;
    }

    .btn-back:hover {
        background: #b9b9b9;
    }

    .btn-area {
        margin-top: 30px;
        display: flex;
        gap: 20px;
    }
</style>

<div class="form-container">

    <h2>➕ Tambah Mekanik</h2>

    @if ($errors->any())
        <div style="background:#ffe5e5; padding:10px; border-radius:6px; margin-bottom:20px;">
            <ul style="margin:0; padding-left:20px; color:#d20000;">
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
                    <option value="{{ $workshop->bengkel_id }}">{{ $workshop->nama_bengkel }}</option>
                @endforeach
            </select>
        </div>

        <div class="btn-area">
            <a href="{{ route('admin.mekanik.index') }}" class="btn-back">Cancel</a>
            <button type="submit" class="btn-submit">Simpan</button>
        </div>
    </form>
</div>
@endsection
