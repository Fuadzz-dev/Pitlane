@extends('admin.layouts.App')

@section('title', 'Add New Motorcycle')
@section('page-title', 'Add New Motorcycle')

@section('content')
<div class="content-section">

    <h2>Add New Motorcycle</h2>

    <form action="{{ route('admin.motorcycles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label >Nama Kendaraan</label>
            <input type="text" name="nama_kendaraan" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Foto Kendaraan</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn-primary">Save</button>
        <a href="{{ route('admin.motorcycles.index') }}" class="btn-secondary">Cancel</a>
    </form>

</div>

<style>
    .content-section {
        padding: 30px;
        background: rgba(255,255,255,0.05);
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }
    .form-group {
        margin-bottom: 20px;
        margin-top: 20px;
        color: #000000;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        margin: 10px;
        border-radius: 8px;
        border: none;
        background-color: #7e71c7;
    }
    .btn-primary {
        padding: 10px 20px;
        background: #667eea;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .btn-secondary {
        padding: 10px 20px;
        background: #bbb;
        color: black;
        border-radius: 8px;
        text-decoration: none;
    }
</style>
@endsection
