@extends('layouts.App')

@section('title', 'Tambah Santri')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Tambah Santri</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/santri">Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Santri</li>
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

                <form class="needs-validation" action="{{ route('santri.store') }}" method="POST">
                @csrf
                    {{-- Username dan Password --}}
                    <div class="row">
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


                        {{-- Form Santri --}}
                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nama_panggil" class="form-label">Nama Panggil</label>
                            <input type="text" class="form-control" name="nama_panggil" value="{{ old('nama_panggil') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
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

                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pendidikan_asal" class="form-label">Pendidikan Asal</label>
                            <input type="text" class="form-control" name="pendidikan_asal" value="{{ old('pendidikan_asal') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" value="{{ old('nama_ayah') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_hp_ayah" class="form-label">No HP Ayah</label>
                            <input type="text" class="form-control" name="no_hp_ayah" value="{{ old('no_hp_ayah') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" value="{{ old('nama_ibu') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_hp_ibu" class="form-label">No HP Ibu</label>
                            <input type="text" class="form-control" name="no_hp_ibu" value="{{ old('no_hp_ibu') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select class="form-select" name="id_kelas" required>
                                <option value="" disabled selected>-- Pilih Kelas --</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id_kelas }}" {{ old('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="" disabled {{ old('status') ? '' : 'selected' }}>-- Pilih Status --</option>
                                <option value="calon" {{ old('status') == 'calon' ? 'selected' : '' }}>Calon</option>
                                <option value="santri" {{ old('status') == 'santri' ? 'selected' : '' }}>Santri</option>
                            </select>
                        </div>
                        
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('santri.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
