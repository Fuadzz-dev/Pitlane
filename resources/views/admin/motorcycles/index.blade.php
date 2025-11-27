@extends('admin.layouts.App')

@section('title', 'Motor Management')
@section('page-title', 'Motor Management')

@section('content')
<div class="content-section">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Motor</h2>
        <a href="{{ route('admin.motorcycles.create') }}" class="btn-primary">+ Tambah Motor</a>
    </div>

    <div class="motorcycle-grid">
        @foreach($motorcycles as $motor)
        <div class="motor-card">
            @if($motor->foto)
                <img src="data:image/jpeg;base64,{{ base64_encode($motor->foto) }}" alt="{{ $motor->nama_kendaraan }}">
            @else
                <div class="no-image">No Image</div>
            @endif
            <h3>{{ $motor->nama_kendaraan }}</h3>
            <div class="card-actions">
                <a href="{{ route('admin.motorcycles.edit', $motor->kendaraan_id) }}" class="btn-edit">Edit</a>
            </div>
        </div>
        @endforeach
    </div>

</div>

@section('styles')
<style>
    .content-section {
        padding: 30px;
        background: rgba(255,255,255,0.05);
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    .motorcycle-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .motor-card {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border-radius: 18px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .motor-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 10px;
    }

    .motor-card .no-image {
        width: 100%;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ccc;
        color: #333;
        border-radius: 12px;
        margin-bottom: 10px;
    }

    .motor-card h3 {
        margin: 10px 0;
        color: #fff;
    }

    .card-actions {
        display: flex;
        justify-content: space-around;
        margin-top: 10px;
    }

    .btn-edit, .btn-delete {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-edit {
        background: #3498db;
        color: #fff;
    }

    .btn-edit:hover {
        background: #2980b9;
    }

    .btn-delete {
        background: #e74c3c;
        color: #fff;
    }

    .btn-delete:hover {
        background: #c0392b;
    }

    .btn-primary {
        padding: 12px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
</style>
@endsection
@endsection
