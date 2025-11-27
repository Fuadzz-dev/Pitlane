@extends('admin.layouts.App')

@section('content')
<style>
    .edit-workshop-container {
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

    .edit-workshop-container h2 {
        margin-bottom: 30px;
        font-size: 28px;
        text-align: center;
        color: #f1c40f;
    }

    .edit-workshop-container label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: #f0f0f0;
    }

    .edit-workshop-container input,
    .edit-workshop-container textarea {
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

    .edit-workshop-container input:focus,
    .edit-workshop-container textarea:focus {
        border-color: #f1c40f;
        background: rgba(255,255,255,0.15);
        outline: none;
    }

    .edit-workshop-container button,
    .edit-workshop-container a.button {
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

    .edit-workshop-container button.update {
        background: #f1c40f;
        color: #fff;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .edit-workshop-container button.update:hover {
        background: #d4ac0d;
    }

    .edit-workshop-container a.button.cancel {
        background: #ccc;
        color: #333;
        margin-left: 10px;
    }

    .edit-workshop-container a.button.cancel:hover {
        background: #b3b3b3;
    }

    .edit-workshop-container button.delete {
        background: #e74c3c;
        color: #fff;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .edit-workshop-container button.delete:hover {
        background: #c0392b;
    }

    hr {
        border: none;
        border-top: 1px solid rgba(255,255,255,0.3);
        margin: 30px 0;
    }
</style>

<div class="edit-workshop-container">
    <h2>Edit Bengkel</h2>

    <form action="{{ route('admin.workshops.update', $workshop->bengkel_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Bengkel</label>
        <input type="text" name="nama_bengkel" value="{{ $workshop->nama_bengkel }}" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3" required>{{ $workshop->alamat }}</textarea>

        <label>No HP</label>
        <input type="text" name="no_hp" value="{{ $workshop->no_hp }}">

        <label>Jam Operasional</label>
        <input type="text" name="jam_operasional" value="{{ $workshop->jam_operasional }}">

        <label>Link Alamat Google Maps</label>
        <input type="text" name="link_alamat" value="{{ $workshop->link_alamat }}">

        <button type="submit" class="update">Update</button>
        <a href="{{ route('admin.workshops.index') }}" class="button cancel">Batal</a>
    </form>

    <hr>

    <form action="{{ route('admin.workshops.destroy', $workshop->bengkel_id) }}" method="POST"
          onsubmit="return confirm('Yakin ingin menghapus bengkel ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete">Hapus Bengkel</button>
    </form>
</div>
@endsection
