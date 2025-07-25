@extends('layouts/layoutMaster')

@section('title', 'Edit Santri')

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

            <form id="formSantriEdit" action="{{ route('santri.update', $santri->id_santri) }}" method="POST" class="row g-4 needs-validation">
            @csrf
            @method('PUT')

            <div class="col-12">
                <h4 class="fw-bold">Edit Data Santri</h4>
            </div>

            {{-- 1. Akun Santri --}}
            <div class="col-12">
                <h6>1. Akun Santri</h6>
                <hr />
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" name="username" class="form-control" value="{{ old('username', $santri->user->username ?? '') }}" placeholder="Username" required>
                <label for="username">Username</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <label for="password">Password Baru</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
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
                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $santri->nama_lengkap) }}" placeholder="Nama Lengkap" required>
                <label for="nama_lengkap">Nama Lengkap</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" name="nama_panggil" class="form-control" value="{{ old('nama_panggil', $santri->nama_panggil) }}" placeholder="Nama Panggil" required>
                <label for="nama_panggil">Nama Panggil</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $santri->tanggal_lahir) }}" placeholder="Tanggal Lahir" required>
                <label for="tanggal_lahir">Tanggal Lahir</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <textarea name="alamat" class="form-control" placeholder="Alamat" rows="2" required>{{ old('alamat', $santri->alamat) }}</textarea>
                <label for="alamat">Alamat</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $santri->no_telepon) }}" placeholder="No Telepon" required>
                <label for="no_telepon">No Telepon</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="email" name="email" class="form-control" value="{{ old('email', $santri->email) }}" placeholder="Email" required>
                <label for="email">Email (Opsional)</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <select class="form-select" name="jenis_kelamin" required>
                    <option value="L" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <label for="jenis_kelamin">Jenis Kelamin</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" name="pendidikan_asal" class="form-control" value="{{ old('pendidikan_asal', $santri->pendidikan_asal) }}" placeholder="Pendidikan Asal" required>
                <label for="pendidikan_asal">Pendidikan Asal</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <select class="form-select" name="id_kelas" required>
                    <option value="" disabled>-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ old('id_kelas', $santri->id_kelas) == $k->id_kelas ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
                <label for="id_kelas">Kelas</label>
                </div>
            </div>
				
				<div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <select class="form-select" name="id_tahun_ajaran" required>
                    <option value="" disabled>-- Pilih Tahun Ajaran --</option>
                    @foreach ($tahunAjaran as $ta)
                    <option value="{{ $ta->id_tahun_ajaran }}" {{ old('id_tahun_ajaran', $santri->id_tahun_ajaran) == $ta->id_tahun_ajaran ? 'selected' : '' }}>
                        {{ $ta->tahun_ajaran }}
                    </option>
                    @endforeach
                </select>
                <label for="id_tahun_ajaran">Tahun Ajaran</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <select class="form-select" name="status" required>
                    <option value="" disabled>-- Pilih Status --</option>
                    <option value="calon" {{ old('status', $santri->status) == 'calon' ? 'selected' : '' }}>Calon</option>
                    <option value="santri" {{ old('status', $santri->status) == 'santri' ? 'selected' : '' }}>Santri</option>
                </select>
                <label for="status">Status</label>
                </div>
            </div>

            {{-- 3. Data Orang Tua --}}
            <div class="col-12">
                <h6 class="mt-2">3. Data Orang Tua</h6>
                <hr />
            </div>

            @foreach ([
                'ayah' => 'Ayah',
                'ibu' => 'Ibu'
            ] as $prefix => $label)
            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" name="nama_{{ $prefix }}" class="form-control" value="{{ old('nama_'.$prefix, $santri->{'nama_'.$prefix}) }}" placeholder="Nama {{ $label }}" required>
                <label for="nama_{{ $prefix }}">Nama {{ $label }}</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" name="pekerjaan_{{ $prefix }}" class="form-control" value="{{ old('pekerjaan_'.$prefix, $santri->{'pekerjaan_'.$prefix}) }}" placeholder="Pekerjaan {{ $label }}" required>
                <label for="pekerjaan_{{ $prefix }}">Pekerjaan {{ $label }}</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" name="no_hp_{{ $prefix }}" class="form-control" value="{{ old('no_hp_'.$prefix, $santri->{'no_hp_'.$prefix}) }}" placeholder="No HP {{ $label }}" required>
                <label for="no_hp_{{ $prefix }}">No HP {{ $label }}</label>
                </div>
            </div>
            @endforeach

            <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('santri.index') }}" class="btn btn-secondary">← Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</main>
@endsection
