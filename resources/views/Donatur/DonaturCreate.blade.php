@extends('layouts/layoutMaster')

@section('title', 'Tambah Donatur')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/tagify/tagify.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/tagify/tagify.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/form-validation-donatur.js'])
@endsection

@section('content')
<main class="app-main">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formDonaturCreate" class="row g-4 needs-validation" action="{{ route('donatur.store') }}" method="POST">
                    @csrf

                    <div class="col-12">
                        <h4 class="fw-bold">Tambah Donatur Baru</h4>
                    </div>

                    {{-- 1. Akun Donatur --}}
                    <div class="col-12">
                        <h6>1. Akun Donatur</h6>
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                            <label>Username</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    <label>Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                                    <label>Konfirmasi Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Data Pribadi --}}
                    <div class="col-12">
                        <h6 class="mt-2">2. Data Pribadi</h6>
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}" required>
                            <label>Nama</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <textarea name="alamat" class="form-control h-px-100" placeholder="Alamat" style="height: 100px" required>{{ old('alamat') }}</textarea>
                            <label>Alamat</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="no_telepon" class="form-control" placeholder="No Telepon" value="{{ old('no_telepon') }}">
                            <label>No Telepon</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            <label>Email</label>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('donatur.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection
