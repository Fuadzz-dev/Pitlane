@extends('admin.layouts.App')

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

    /* Tombol badge status */
    .badge-status {
        padding: 6px 14px;
        background: #fff3a0;
        color: #7a6f00;
        font-size: 13px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
    }

    /* Tombol update */
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
</style>

<div class="content-section">
    <h2 style="margin-bottom: 20px;">Daftar Bengkel</h2>

    <div style="margin-bottom: 20px; text-align:right;">
        <a href="{{ Route('admin.workshops.create') }}"
            style="padding:10px 20px;
                  background:#667eea;
                  color:white;
                  border-radius:12px;
                  text-decoration:none;
                  font-weight:500;
                  box-shadow:0 4px 12px rgba(0,0,0,0.2);">
            + Tambah Bengkel
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Bengkel</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Jam Operasional</th>
                    <th>Link Alamat</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($workshops as $w)
                <tr>
                    <td>#{{ $w->bengkel_id }}</td>
                    <td>{{ $w->nama_bengkel }}</td>
                    <td>{{ $w->alamat }}</td>
                    <td>{{ $w->no_hp ?? '-' }}</td>
                    <td>{{ $w->jam_operasional ?? '-' }}</td>
                    <td>
                        @if($w->link_alamat)
                            <a href="{{ $w->link_alamat }}" target="_blank" style="color:#9bb8ff">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ Route('admin.workshops.edit', $w->bengkel_id) }}"
                            class="btn-action">
                            Update
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:20px; color:white;">
                        Tidak ada data bengkel.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
