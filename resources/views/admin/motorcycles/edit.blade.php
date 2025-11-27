@extends('admin.layouts.App')

@section('title', 'Edit Motorcycle')
@section('page-title', 'Edit Motorcycle')

@section('content')
<div class="edit-workshop-container">
    <h2>Edit Motorcycle</h2>

    <form action="{{ route('admin.motorcycles.update', $motorcycle->kendaraan_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama Motor</label>
        <input type="text" name="nama_kendaraan" value="{{ $motorcycle->nama_kendaraan }}" required>

        <label>Foto Motor</label>
        <input type="file" name="foto" accept="image/*">

        @if($motorcycle->foto)
            <p>Current Photo:</p>
            <img src="data:image/jpeg;base64,{{ base64_encode($motorcycle->foto) }}" alt="Motor Photo" class="current-photo">
        @endif

        <div class="form-buttons">
            <button type="submit" class="update">Update</button>
            <a href="{{ route('admin.motorcycles.index') }}" class="button cancel">Cancel</a>
        </div>
    </form>
</div>

@section('styles')
<style>
    .edit-workshop-container {
        max-width: 500px;
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

    label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
    }

    input {
        width: 100%;
        padding: 12px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.3);
        background: rgba(255,255,255,0.1);
        color: #fff;
        margin-bottom: 20px;
    }

    .current-photo {
        width: 200px;
        border-radius: 12px;
        display: block;
        margin-bottom: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .form-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .update {
        background: #f1c40f;
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 12px;
        cursor: pointer;
        flex: 1;
        margin-right: 10px;
    }

    .update:hover {
        background: #d4ac0d;
    }

    .button.cancel {
        background: #ccc;
        color: #333;
        padding: 12px 25px;
        border-radius: 12px;
        text-decoration: none;
        flex: 1;
        text-align: center;
    }
</style>
@endsection
@endsection
