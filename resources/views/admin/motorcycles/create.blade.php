@extends('admin.layouts.App')

@section('content')
<div class="form-wrapper">

    <h2 class="form-title">➕ Add New Motorcycle</h2>

    <form action="{{ route('admin.motorcycles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="input-group">
            <label>Nama Kendaraan</label>
            <input type="text" name="nama_kendaraan" placeholder="Masukkan nama motor..." required>
        </div>

        <div class="input-group">
            <label>Foto Kendaraan</label>
            <input type="file" name="foto">
        </div>

        <div class="btn-area">
            <a href="{{ route('admin.motorcycles.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit">Save</button>
        </div>
    </form>

</div>
@endsection

@section('styles')
<style>
/* Background */
body {
    background: linear-gradient(135deg, #5c4bff, #8c61ff);
}

/* Card kaca */
.form-wrapper {
    background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.08));
    padding: 45px 60px;
    border-radius: 30px;
    backdrop-filter: blur(14px);
    width: 92%;
    max-width: 1000px;
    margin: 40px auto;
    color: #fff;
}

/* Judul */
.form-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 35px;
}

/* Input field */
.input-group {
    margin-bottom: 28px;
}

.input-group label {
    font-size: 17px;
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
}

.input-group input {
    width: 100%;
    padding: 18px;
    border-radius: 14px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.22);
    color: #fff;
    font-size: 16px;
}

/* Tombol */
.btn-area {
    margin-top: 40px;
    display: flex;
    gap: 14px;
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
    background: linear-gradient(135deg, #5a93ff, #3f63ff);
}
</style>
@endsection
