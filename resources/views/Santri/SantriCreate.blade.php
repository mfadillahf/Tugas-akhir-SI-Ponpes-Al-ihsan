@extends('layouts/layoutMaster')

@section('title', 'Tambah Santri')

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
@vite(['resources/assets/js/form-validation-santri.js'])
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

        <form id="formSantriCreate" action="{{ route('santri.store') }}" method="POST" class="row g-4 needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <h4 class="fw-bold">Tambah Santri Baru</h4>
            </div>
            <!-- 1. Account Details -->
            <div class="col-12">
                <h6>1. Akun Santri</h6>
                <hr />
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                <label for="username">Username</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                    <label for="password_confirmation">Konfirmasi Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                </div>
                </div>
            </div>

            <!-- 2. Data Pribadi -->
            <div class="col-12">
                <h6 class="mt-2">2. Data Pribadi</h6>
                <hr />
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" required>
                <label for="nama_lengkap">Nama Lengkap</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="nama_panggil" name="nama_panggil" class="form-control" placeholder="Nama Panggil" value="{{ old('nama_panggil') }}" required>
                <label for="nama_panggil">Nama Panggil</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="DD-MM-YYYY" value="{{ old('tanggal_lahir') }}" required>
                <label for="tanggal_lahir">Tanggal Lahir</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" rows="2">{{ old('alamat') }}</textarea>
                <label for="alamat">Alamat</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="no_telepon" name="no_telepon" class="form-control" placeholder="No Telepon" value="{{ old('no_telepon') }}">
                <label for="no_telepon">No Telepon</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                <label for="email">Email (Opsional)</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <label for="jenis_kelamin">Jenis Kelamin</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" id="pendidikan_asal" name="pendidikan_asal" class="form-control" placeholder="Pendidikan Asal" value="{{ old('pendidikan_asal') }}" required>
                    <label for="pendidikan_asal">Pendidikan Asal</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <select class="form-select" id="id_kelas" name="id_kelas" required>
                    <option value="" disabled selected>-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ old('id_kelas') == $k->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
                <label for="id_kelas">Kelas</label>
                </div>
            </div>
			<div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <select class="form-select" id="id_tahun_ajaran" name="id_tahun_ajaran" required>
                    <option value="" disabled selected>-- Pilih Tahun Ajaran --</option>
                    @foreach($tahunAjaran as $ta)
                    <option value="{{ $ta->id_tahun_ajaran }}" {{ old('id_tahun_ajaran') == $ta->id_tahun_ajaran ? 'selected' : '' }}>{{ $ta->tahun_ajaran }}</option>
                    @endforeach
                </select>
                <label for="id_tahun_ajaran">Tahun Ajaran</label>
                </div>
            </div>
            <!--  Status -->
            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <select class="form-select" id="status" name="status" required>
                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>-- Pilih Status --</option>
                    <option value="calon" {{ old('status') == 'calon' ? 'selected' : '' }}>Calon</option>
                    <option value="santri" {{ old('status') == 'santri' ? 'selected' : '' }}>Santri</option>
                </select>
                <label for="status">Status</label>
                </div>
            </div>

            <!-- 3. Data Orang Tua -->
            <div class="col-12">
                <h6 class="mt-2">3. Data Orang Tua</h6>
                <hr />
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="nama_ayah" name="nama_ayah" class="form-control" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}" required>
                <label for="nama_ayah">Nama Ayah</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah" value="{{ old('pekerjaan_ayah') }}" required>
                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="no_hp_ayah" name="no_hp_ayah" class="form-control" placeholder="No HP Ayah" value="{{ old('no_hp_ayah') }}" required>
                <label for="no_hp_ayah">No HP Ayah</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="nama_ibu" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}" required>
                <label for="nama_ibu">Nama Ibu</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu" value="{{ old('pekerjaan_ibu') }}" required>
                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="no_hp_ibu" name="no_hp_ibu" class="form-control" placeholder="No HP Ibu" value="{{ old('no_hp_ibu') }}" required>
                <label for="no_hp_ibu">No HP Ibu</label>
                </div>
            </div>
            <!-- Submit -->
            <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('santri.index') }}" class="btn btn-secondary">← Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
        </div>
    </div>
</main>
@endsection
