@extends('layouts/layoutMaster')

@section('title', 'Edit Profil Santri')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/tagify/tagify.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

<!-- Vendor Scripts -->
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

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/pages-profile-santri-edit.js'])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-6">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Profil Santri</h5>
        </div>
        <div class="card-body pt-0">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="formAccountSettings" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-4 needs-validation">
            @csrf
            <div class="row mt-1 g-5">
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username', auth()->user()->username) }}" required>
                    <label for="username">Username</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Kosongkan jika tidak ingin ubah">
                    <label for="password">Password Baru</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    <label for="password_confirmation">Konfirmasi Password</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $profile->nama_lengkap) }}" required>
                    <label for="nama_lengkap">Nama Lengkap</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="nama_panggil" id="nama_panggil" value="{{ old('nama_panggil', $profile->nama_panggil) }}" required>
                    <label for="nama_panggil">Nama Panggilan</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $profile->tanggal_lahir) }}" required>
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $profile->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $profile->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="pendidikan_asal" id="pendidikan_asal" value="{{ old('pendidikan_asal', $profile->pendidikan_asal) }}" required>
                    <label for="pendidikan_asal">Pendidikan Asal</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <textarea class="form-control h-px-50" placeholder="Alamat lengkap" name="alamat" id="alamat" style="height: 100px" required>{{ old('alamat', $profile->alamat) }}</textarea>
                    <label for="alamat">Alamat</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $profile->no_telepon) }}">
                    <label for="no_telepon">No Telepon</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $profile->email) }}">
                    <label for="email">Email</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah', $profile->nama_ayah) }}" required>
                    <label for="nama_ayah">Nama Ayah</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $profile->pekerjaan_ayah) }}" required>
                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="no_hp_ayah" id="no_hp_ayah" value="{{ old('no_hp_ayah', $profile->no_hp_ayah) }}" required>
                    <label for="no_hp_ayah">No HP Ayah</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu', $profile->nama_ibu) }}" required>
                    <label for="nama_ibu">Nama Ibu</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $profile->pekerjaan_ibu) }}" required>
                    <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="no_hp_ibu" id="no_hp_ibu" value="{{ old('no_hp_ibu', $profile->no_hp_ibu) }}" required>
                    <label for="no_hp_ibu">No HP Ibu</label>
                </div>
                </div>
            </div>
            <div class="mt-6 d-flex justify-content-end gap-2">
                <a href="{{ route('profile.show') }}" class="btn btn-secondary">← Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection
