@extends('layouts.App')

@section('title', 'Edit Donatur')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Donatur</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/donatur">Donatur</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Donatur</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">
                {{-- Error Validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="needs-validation" action="{{ route('donatur.update', $donatur->id_donatur) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username', $donatur->user->username ?? '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password Baru (Kosongkan jika tidak ingin ganti)</label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" value="">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama', $donatur->nama) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $donatur->alamat) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_telepon" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon', $donatur->no_telepon) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $donatur->email) }}" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('donatur.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
