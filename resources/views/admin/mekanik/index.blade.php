@extends('admin.layouts.App')

@section('title', 'Mekanik Management')
@section('page-title', 'Mekanik Management')


@section('content')

<style>
    /* Container tabel */
    .table-container {
        width: 100%;
        overflow-x: auto;
        border-radius: 12px;
        background: rgba(255,255,255,0.05);
        padding: 10px;
    }

    /* Tabel */
    table {
        width: 100%;
        border-collapse: collapse;
        color: #f8f8f8;
        background: rgba(255,255,255,0.05);
        border-radius: 12px;
        overflow: hidden;
    }

    /* Header */
    thead tr th {
        padding: 14px;
        text-align: left;
        font-weight: 600;
        background: linear-gradient(90deg, #6a5acd, #6a67d8, #5b6ee1);
        color: #fff;
    }

    /* Isi tabel */
    tbody tr {
        background: rgba(255,255,255,0.07);
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    tbody tr td {
        padding: 14px;
        color: #ddd;
        font-size: 15px;
    }

    /* Hover */
    tbody tr:hover {
        background: rgba(255,255,255,0.12);
    }

    /* Tombol Edit */
    .btn-action {
        padding: 8px 16px;
        background: linear-gradient(90deg, #5d8dee, #6d65e8);
        border-radius: 10px;
        color: white;
        font-size: 14px;
        text-decoration: none;
        font-weight: 500;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    /* Tombol Tambah */
    .btn-add {
        padding: 10px 20px;
        background: #667eea;
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
</style>

<div class="content-section">
    <h2 style="margin-bottom: 20px;">Daftar Mekanik</h2>

    <div style="margin-bottom: 20px; text-align:right; ">
        <a href="{{ Route('admin.mekanik.create') }}" class="btn-add" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">+ Tambah Mekanik</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Mekanik</th>
                    <th>No HP</th>
                    <th>Bengkel</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($mekanik as $m)
                <tr>
                    <td>{{ $m->nama_mekanik }}</td>
                    <td>{{ $m->no_hp }}</td>
                    <td>{{ $m->workshop->nama_bengkel ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.mekanik.edit', $m->mekanik_id) }}" class="btn-action">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px; color:white;">
                        Belum ada data mekanik.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection
