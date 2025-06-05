@extends('layouts.App')

@section('title', 'Profil Donatur')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Profil Donatur</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.donatur') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Nama</th><td>{{ $profile->nama }}</td></tr>
                        <tr><th>Alamat</th><td>{{ $profile->alamat }}</td></tr>
                        <tr><th>No Telepon</th><td>{{ $profile->no_telepon }}</td></tr>
                        <tr><th>Email</th><td>{{ $profile->email }}</td></tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
