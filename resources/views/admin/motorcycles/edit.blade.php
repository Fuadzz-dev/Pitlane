@extends('admin.layouts.App')

@section('title', 'Edit Motorcycle')
@section('page-title', 'Edit Motorcycle')

@section('content')
<div class="edit-motorcycle-container">
    <h2>Edit Motorcycle</h2>

    <form action="{{ route('admin.motorcycles.update', $motorcycle->kendaraan_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama Motor</label>
        <input type="text" name="nama_kendaraan" value="{{ $motorcycle->nama_kendaraan }}" required>

        <label>Foto Motor</label>
        <input type="file" name="foto" accept="image/*">

        @if($motorcycle->foto)
            <p style="margin: 10px 0;">Foto Saat Ini:</p>
            <img src="data:image/jpeg;base64,{{ base64_encode($motorcycle->foto) }}" alt="Motor Photo" class="current-photo">
        @endif

        <div class="form-buttons">
            <button type="submit" class="btn-save">Simpan Perubahan</button>
            <a href="{{ route('admin.motorcycles.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>

    <form action="{{ route('admin.motorcycles.destroy', $motorcycle->kendaraan_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus motor ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">Hapus Motor</button>
    </form>
</div>
@endsection

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #7a5fff, #7158e2, #9b59b6);
        background-size: cover;
        min-height: 100vh;
        padding: 30px 0;
    }

    .edit-motorcycle-container {
        max-width: 750px;
        margin: auto;
        padding: 45px 55px;
        border-radius: 22px;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.25);
        box-shadow: 0 15px 35px rgba(0,0,0,0.25);
        color: #fff;
    }

    .edit-motorcycle-container h2 {
        text-align: center;
        color: #f1c40f;
        font-size: 34px;
        font-weight: 700;
        margin-bottom: 35px;
    }

    label {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
        color: #f7f7f7;
    }

    input {
        width: 100%;
        padding: 15px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,0.4);
        background: rgba(255,255,255,0.1);
        color: #fff;
        font-size: 15px;
        margin-bottom: 22px;
        transition: .3s;
    }

    input:focus {
        border-color: #f1c40f;
        background: rgba(255,255,255,0.18);
        outline: none;
    }

    .current-photo {
        width: 260px;
        border-radius: 14px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.4);
    }

    .form-buttons {
        display: flex;
        justify-content: flex-start;
        gap: 15px;
        margin-top: 10px;
    }

    .btn-save,
    .btn-cancel {
        padding: 13px 32px;
        border-radius: 13px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        text-decoration: none;
        transition: .25s;
    }

    .btn-save {
        background: #f1c40f;
        color: #fff;
    }
    .btn-save:hover { background: #d4ac0d; }

    .btn-cancel {
        background: #ccc;
        color: #333;
    }
    .btn-cancel:hover { background: #bdbcbc; }

    hr {
        border: none;
        border-bottom: 1px solid rgba(255,255,255,0.3);
        margin: 30px 0 20px;
    }

    .btn-delete {
    margin-top: 20px;
    margin-left: auto;
    padding: 13px 28px;
    border-radius: 13px;
    background: #e74c3c;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    box-shadow: 0 5px 18px rgba(231,76,60,0.5);
    transition: .25s;
}
.btn-delete:hover {
    background: #c0392b;
}

</style>
@endsection
