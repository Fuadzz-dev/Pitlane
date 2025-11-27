@extends('admin.layouts.App')

@section('content')
<div class="form-container">
    <h2 class="form-title">Edit Layanan</h2>

    <form action="{{ route('admin.layanan.update', $layanan->layanan_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Layanan</label>
            <input type="text" name="nama_layanan"
                   value="{{ $layanan->nama_layanan }}"
                   class="input-field" required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga"
                   value="{{ $layanan->harga }}"
                   class="input-field" required>
        </div>

        <div class="form-buttons">
    <a href="{{ route('admin.layanan.index') }}" class="btn-back">Kembali</a>

    <form action="{{ route('admin.layanan.destroy', $layanan->layanan_id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus layanan ini? Data tidak dapat dikembalikan!')"
          style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">Hapus</button>
    </form>

    <button type="submit" class="btn-submit">Simpan Perubahan</button>
</div>
    </form>
</div>
@endsection


@section('styles')
<style>
.form-container {
    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(14px);
    padding: 32px;
    border-radius: 20px;
    max-width: 550px;
    margin: auto;
    color: #fff;
    box-shadow: 0 6px 20px rgba(0,0,0,0.35);
}
.form-title {
    font-size: 24px;
    margin-bottom: 22px;
    font-weight: 700;
    text-align: center;
}
.form-group {
    margin-bottom: 18px;
}
.form-group label {
    font-size: 15px;
    font-weight: 600;
}
.input-field {
    width: 100%;
    margin-top: 7px;
    padding: 13px;
    border-radius: 12px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.12);
    font-size: 14px;
    color: #fff;
}
.input-field:focus {
    background: rgba(255,255,255,0.16);
    box-shadow: 0 0 0 2px #7b83ff;
}
.form-buttons {
    margin-top: 26px;
    display: flex;
    justify-content: flex-end;
}
.btn-submit {
    padding: 11px 26px;
    background: linear-gradient(90deg, #57a1ff, #6a63ff);
    border-radius: 12px;
    border: none;
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    transition: .25s;
}
.btn-submit:hover {
    opacity: .88;
}
.btn-back {
    padding: 11px 26px;
    background: linear-gradient(90deg, #8e8e8e, #6d6d6d);
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    color: #fff;
}
.btn-back:hover {
    opacity: .88;
}

.btn-delete {
    padding: 11px 26px;
    background: linear-gradient(90deg, #ff6b6b, #ff3b3b);
    border-radius: 12px;
    border: none;
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    transition: .25s;
    margin: 0 8px;
}
.btn-delete:hover {
    opacity: .88;
}

</style>
@endsection
