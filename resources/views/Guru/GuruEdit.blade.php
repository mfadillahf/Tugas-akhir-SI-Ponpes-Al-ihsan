@extends('layouts/layoutMaster')

@section('title', 'Edit Guru')

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
@vite(['resources/assets/js/form-validation-guru.js'])
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

            <form id="formGuruEdit" action="{{ route('guru.update', $guru->id_guru) }}" method="POST" class="row g-4 needs-validation">
            @csrf
            @method('PUT')

            <div class="col-12">
                <h4 class="fw-bold">Edit Guru</h4>
            </div>

            {{-- 1. Akun Guru --}}
            <div class="col-12">
                <h6>1. Akun Guru</h6>
                <hr />
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username', $guru->user->username ?? '') }}" required>
                    <label for="username">Username</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password Baru (Opsional)">
                    <label for="password">Password Baru (Opsional)</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                    <label for="password_confirmation">Konfirmasi Password</label>
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
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama', $guru->nama) }}" required>
                    <label for="nama">Nama Lengkap</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="{{ old('nip', $guru->nip) }}">
                    <label for="nip">NIP</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $guru->email) }}">
                    <label for="email">Email</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" id="no_telepon" name="no_telepon" class="form-control" placeholder="No Telepon" value="{{ old('no_telepon', $guru->no_telepon) }}">
                    <label for="no_telepon">No Telepon</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" required>
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">← Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

            </form>
        </div>
        </div>
    </div>
</main>
@endsection
