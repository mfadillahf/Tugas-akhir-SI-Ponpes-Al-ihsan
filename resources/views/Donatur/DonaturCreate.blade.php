@extends('layouts.App')

@section('title', 'Tambah Donatur')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tambah Donatur</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('donatur.index') }}">Donatur</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Donatur</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width:  980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">
                {{-- Tampilkan error validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="needs-validation" action="{{ route('donatur.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- Username dan Password --}}
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        {{-- Data donatur --}}
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_telepon" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('donatur.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
