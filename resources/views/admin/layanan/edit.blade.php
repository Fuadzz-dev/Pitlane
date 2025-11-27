@extends('admin.layouts.App')

@section('content')
<style>
    .edit-service-container {
        max-width: 700px;
        margin: 40px auto;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 30px 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
    }

    .edit-service-container h2 {
        margin-bottom: 30px;
        font-size: 28px;
        text-align: center;
        color: #f1c40f;
    }

    .edit-service-container label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: #f0f0f0;
    }

    .edit-service-container input {
        width: 100%;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.3);
        background: rgba(255,255,255,0.1);
        color: #fff;
        font-size: 14px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .edit-service-container input:focus {
        border-color: #f1c40f;
        background: rgba(255,255,255,0.15);
        outline: none;
    }

    .edit-service-container button,
    .edit-service-container a.button {
        padding: 12px 25px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        margin-top: 10px;
    }

    .btn-save {
        background: #f1c40f;
        color: #fff;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .btn-save:hover {
        background: #d4ac0d;
    }

    .btn-cancel {
        background: #ccc;
        color: #333;
        margin-left: 10px;
    }

    .btn-cancel:hover {
        background: #b3b3b3;
    }

    .btn-delete {
        background: #e74c3c;
        color: #fff;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .btn-delete:hover {
        background: #c0392b;
    }

    hr {
        border: none;
        border-top: 1px solid rgba(255,255,255,0.3);
        margin: 30px 0;
    }
</style>

<div class="edit-service-container">
    <h2>Edit Layanan</h2>

    <form action="{{ route('admin.layanan.update', $layanan->layanan_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Layanan</label>
        <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" required>

        <label>Harga</label>
        <input type="number" name="harga" value="{{ $layanan->harga }}" required>

        <button type="submit" class="btn-save">Simpan Perubahan</button>
        <a href="{{ route('admin.layanan.index') }}" class="button btn-cancel">Batal</a>
    </form>

    <hr>

    <form action="{{ route('admin.layanan.destroy', $layanan->layanan_id) }}" method="POST"
          onsubmit="return confirm('Yakin ingin menghapus layanan ini? Data tidak dapat dikembalikan!')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">Hapus Layanan</button>
    </form>
</div>

@endsection
