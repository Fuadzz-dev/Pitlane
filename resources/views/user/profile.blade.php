@extends('user.layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-4">

    {{-- Judul --}}

    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- Foto Profil --}}
            <div class="text-center mb-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=120"
                     class="rounded-circle"
                     alt="Foto Profil">
            </div>

            {{-- Informasi User --}}
            <table class="table table-borderless">
                <tr>
                    <th style="width: 150px;">Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <td>{{ $user->phone ?? '-' }}</td>
                </tr>
            </table>

            <hr>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('user.home') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <a href="#" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit Profil
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
