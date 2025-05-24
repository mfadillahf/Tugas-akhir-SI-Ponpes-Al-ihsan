@extends('layouts.App')

@section('title', 'Edit Santri')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/santri">Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Santri</li>
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

                <form class="needs-validation" action="{{ route('santri.update', $santri->id_santri) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username', $santri->user->username ?? '') }}" required>
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
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $santri->nama_lengkap) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_panggil" class="form-label">Nama Panggil</label>
                            <input type="text" class="form-control" name="nama_panggil" value="{{ old('nama_panggil', $santri->nama_panggil) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $santri->tanggal_lahir) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $santri->alamat) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_telepon" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon', $santri->no_telepon) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $santri->email) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="L" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pendidikan_asal" class="form-label">Pendidikan Asal</label>
                            <input type="text" class="form-control" name="pendidikan_asal" value="{{ old('pendidikan_asal', $santri->pendidikan_asal) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" value="{{ old('nama_ayah', $santri->nama_ayah) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $santri->pekerjaan_ayah) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_hp_ayah" class="form-label">No HP Ayah</label>
                            <input type="text" class="form-control" name="no_hp_ayah" value="{{ old('no_hp_ayah', $santri->no_hp_ayah) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" value="{{ old('nama_ibu', $santri->nama_ibu) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $santri->pekerjaan_ibu) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_hp_ibu" class="form-label">No HP Ibu</label>
                            <input type="text" class="form-control" name="no_hp_ibu" value="{{ old('no_hp_ibu', $santri->no_hp_ibu) }}" required>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="id_kelas" class="form-label">Pilih Kelas</label>
                            <select name="id_kelas" class="form-select" required>
                                <option value="" disabled>-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id_kelas }}" {{ $santri->id_kelas == $k->id_kelas ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="" disabled>-- Pilih Status --</option>
                                <option value="calon" {{ old('status', $santri->status) == 'calon' ? 'selected' : '' }}>Calon</option>
                                <option value="santri" {{ old('status', $santri->status) == 'santri' ? 'selected' : '' }}>Santri</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('santri.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
