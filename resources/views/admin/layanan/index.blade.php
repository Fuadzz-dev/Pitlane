@extends('admin.layouts.App')

@section('content')
<div class="content-section">
    <h2 style="margin-bottom: 20px; color:#fff; font-weight:600;">Daftar Layanan</h2>

    <div style="margin-bottom: 20px; text-align:right;">
        <a href="{{ route('admin.layanan.create') }}"
           style="padding:10px 22px;
                  background:#667eea;
                  color:white;
                  border-radius:12px;
                  text-decoration:none;
                  font-weight:600;
                  box-shadow:0 4px 12px rgba(0,0,0,0.25);">
            + Tambah Layanan
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th style="width:150px; text-align:center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($layanan as $item)
                <tr>
                    <td>{{ $item->nama_layanan }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td style="text-align:center;">
                        <a href="{{ route('admin.layanan.edit', $item->layanan_id) }}"
                           class="btn-action">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <div class="pagination-wrapper">
    {{ $layanan->links('pagination::bootstrap-5') }}
</div>

    </div>
</div>
@endsection


@section('styles')
<style>
/* Container tabel */
.table-container {
    width: 100%;
    overflow-x: auto;
    border-radius: 14px;
    background: rgba(255,255,255,0.05);
    padding: 14px;
}

/* Tabel */
.table-container table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(255,255,255,0.05);
    border-radius: 14px;
    overflow: hidden;
    color: #f8f8f8;
}

/* Header */
.table-container thead th {
    padding: 15px;
    font-weight: 600;
    background: linear-gradient(90deg, #6a5acd, #6b63d4, #5c72e0);
    color: #fff;
    font-size: 15px;
}

/* Body */
.table-container tbody tr {
    background: rgba(255,255,255,0.07);
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.table-container tbody tr:hover {
    background: rgba(255,255,255,0.12);
}
.table-container tbody td {
    padding: 15px;
    font-size: 15px;
    color: #e5e5e5;
}

/* Tombol aksi */
.btn-action {
    padding: 7px 18px;
    background: linear-gradient(90deg, #5d8dee, #6d65e8);
    border-radius: 10px;
    color: #fff;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    margin-right: 4px;
}
.btn-action:hover {
    opacity: 0.9;
}

/* Pagination */
.pagination {
    justify-content: center !important;
    margin-top: 20px;
    display: flex;
    
}

.pagination .page-item {
    margin: 0 3px;
}

.pagination .page-link {
    background: #ffffff1a;
    border: none;
    border-radius: 8px;
    color: #fff;
    padding: 7px 14px;
    font-size: 14px;
    transition: .25s;text-decoration: none;
}

.pagination .page-link:hover {
    background: #6a63ff;
    color: #fff;
    text-decoration: none;
}

.pagination .page-item.active .page-link {
    background: #6a63ff;
    color: #fff;
    font-weight: 600;
}

.pagination .page-item.disabled .page-link {
    background: #ffffff0d;
    color: #777;
}

.pagination-wrapper {
    margin-top: 25px;
    display: flex;
    justify-content: center;
}



</style>
@endsection
