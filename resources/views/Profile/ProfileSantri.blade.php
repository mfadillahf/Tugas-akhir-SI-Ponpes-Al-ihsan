@extends('layouts.App')

@section('title', 'Edit Profil Santri')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Profil Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.santri') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profil Santri</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">
                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

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

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $profile->nama_lengkap) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Panggilan</label>
                            <input type="text" class="form-control" name="nama_panggil" value="{{ old('nama_panggil', $profile->nama_panggil) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $profile->tanggal_lahir) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $profile->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $profile->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan Asal</label>
                            <input type="text" class="form-control" name="pendidikan_asal" value="{{ old('pendidikan_asal', $profile->pendidikan_asal) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $profile->alamat) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon', $profile->no_telepon) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" value="{{ old('nama_ayah', $profile->nama_ayah) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $profile->pekerjaan_ayah) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">No HP Ayah</label>
                            <input type="text" class="form-control" name="no_hp_ayah" value="{{ old('no_hp_ayah', $profile->no_hp_ayah) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" value="{{ old('nama_ibu', $profile->nama_ibu) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $profile->pekerjaan_ibu) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">No HP Ibu</label>
                            <input type="text" class="form-control" name="no_hp_ibu" value="{{ old('no_hp_ibu', $profile->no_hp_ibu) }}" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('dashboard.santri') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
