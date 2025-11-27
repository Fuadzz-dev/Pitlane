@extends('admin.layouts.App')

@section('content')

<style>
    .edit-mechanic-container {
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

    .edit-mechanic-container h2 {
        margin-bottom: 30px;
        font-size: 28px;
        text-align: center;
        color: #f1c40f;
        font-weight: 600;
    }

    .edit-mechanic-container label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: #f0f0f0;
    }

    .edit-mechanic-container input,
    .edit-mechanic-container select {
        width: 100%;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.3);
        background: rgba(255,255,255,0.1);
        color: #fff;
        font-size: 14px;
        margin-bottom: 20px;
        transition: 0.3s ease;
    }

    .edit-mechanic-container input:focus,
    .edit-mechanic-container select:focus {
        border-color: #f1c40f;
        background: rgba(255,255,255,0.15);
        outline: none;
    }

    /* Tombol */
    .edit-mechanic-container button,
    .edit-mechanic-container a.button {
        padding: 12px 25px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
    }

    .edit-mechanic-container button.save {
        background: #f1c40f;
        color: #fff;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .edit-mechanic-container button.save:hover {
        background: #d4ac0d;
    }

    .edit-mechanic-container a.button.cancel {
        background: #ccc;
        color: #333;
        margin-left: 10px;
    }
    .edit-mechanic-container a.button.cancel:hover {
        background: #b3b3b3;
    }

    .edit-mechanic-container button.delete {
        background: #e74c3c;
        color: #fff;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        /* width: 100%; */
    }
    .edit-mechanic-container button.delete:hover {
        background: #c0392b;
    }

    hr {
        border: none;
        border-top: 1px solid rgba(255,255,255,0.3);
        margin: 30px 0;
    }
</style>

<div class="edit-mechanic-container">

    <h2>Edit Data Mekanik</h2>

    @if ($errors->any())
        <div style="background:rgba(255,0,0,0.2); padding:10px; border-radius:8px; margin-bottom:15px;">
            <ul style="margin:0; padding-left:18px; color:#ffcccc;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mekanik.update', $mekanik->mekanik_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Mekanik</label>
        <input type="text" name="nama" value="{{ old('nama', $mekanik->nama_mekanik) }}" required>

        <label>Nomor HP</label>
        <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $mekanik->no_hp) }}" required>

        <label>Pilih Bengkel</label>
        <select name="workshop_id" required>
            @foreach ($workshops as $workshop)
                <option value="{{ $workshop->bengkel_id }}" {{ $mekanik->bengkel_id == $workshop->bengkel_id ? 'selected' : '' }}>
                    {{ $workshop->nama_bengkel }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="save">Simpan Perubahan</button>
        <a href="{{ route('admin.mekanik.index') }}" class="button cancel">Batal</a>
    </form>

    <hr>

    <form action="{{ route('admin.mekanik.destroy', $mekanik->mekanik_id) }}" method="POST"
        onsubmit="return confirm('Yakin ingin menghapus mekanik ini?')">
        @csrf
        @method('DELETE')

        <button type="submit" class="delete">Hapus Mekanik</button>
    </form>
</div>

@endsection
