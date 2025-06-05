@extends('layouts.auth')

@section('title', 'Register')
@section('body-class', 'login-page')

@section('content')
<div class="container" style="margin-top: 40px; max-width: 900px;">
    <div class="card p-4 shadow-sm">
    <h2 class="text-center mb-4 text-primary">Register Santri</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.santri.post') }}">
    @csrf
        <div class="row gy-3 gx-3">
            <div class="col-12 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <hr class="my-3">

            <div class="col-12 col-md-6">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="nama_panggil" class="form-label">Nama Panggilan</label>
                <input type="text" name="nama_panggil" id="nama_panggil" value="{{ old('nama_panggil') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="pendidikan_asal" class="form-label">Pendidikan Asal</label>
                <input type="text" name="pendidikan_asal" id="pendidikan_asal" value="{{ old('pendidikan_asal') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
            </div>
            
            <hr class="my-3">

            <div class="col-12 col-md-6">
                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="no_hp_ayah" class="form-label">No HP Ayah</label>
                <input type="text" name="no_hp_ayah" id="no_hp_ayah" value="{{ old('no_hp_ayah') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="no_hp_ibu" class="form-label">No HP Ibu</label>
                <input type="text" name="no_hp_ibu" id="no_hp_ibu" value="{{ old('no_hp_ibu') }}" class="form-control" required>
            </div>
        </div>


        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary px-4">Daftar</button>
        </div>
        </form>
    </div>
</div>
@endsection
