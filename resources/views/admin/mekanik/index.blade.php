@extends('admin.layouts.app')

@section('content')

<style>
    .page-title {
        font-size: 26px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .btn-add {
        background: #111;
        color: #fff;
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 18px;
        display: inline-block;
    }

    .table-wrapper table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .table-wrapper th {
        background: #f4f4f4;
        padding: 12px;
        text-align: left;
        font-weight: 600;
    }

    .table-wrapper td {
        padding: 10px 12px;
        border-bottom: 1px solid #eee;
    }

    .btn-edit {
        background: #3b82f6;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
        margin-right: 4px;
    }

    .btn-delete {
        background: #dc2626;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        opacity: 0.8;
    }
</style>

<div class="dashboard">
    <h1 class="page-title">👥 Daftar Mekanik</h1>

    <a href="{{ Route('admin.mekanik.create') }}" class="btn-add">➕ Tambah Mekanik</a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Mekanik</th>
                    <th>No HP</th>
                    <th>Bengkel</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mekanik as $mechanic)
                <tr>
                    <td>{{ $mechanic->nama_mekanik }}</td>
                    <td>{{ $mechanic->no_hp }}</td>
                    <td>{{ $mechanic->workshop->nama_bengkel ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.mekanik.edit', $mechanic->mekanik_id) }}" class="btn-edit">✏️ Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 15px; color: #777;">Belum ada data
                        mekanik.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
