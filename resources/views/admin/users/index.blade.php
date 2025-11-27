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

    /* Tombol update/delete */
    .btn-action {
    padding: 7px 18px;
    background: linear-gradient(90deg, #ee5d5d, #da2929);
    border-radius: 10px;
    color: #fff;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    margin-right: 4px;
}
</style>

<div class="content-section">
    <h2 style="margin-bottom: 20px;">Users Management</h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>#{{ $user->user_id }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user->user_id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus user ini?')" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-action">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
