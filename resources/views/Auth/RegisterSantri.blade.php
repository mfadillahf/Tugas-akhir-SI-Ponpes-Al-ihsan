@extends('layouts.landing')

@section('title', 'Register Santri')

@section('content')
<div class="main-content-area">
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" style="padding-top: 120px;" data-tm-bg-img="{{ asset('images/bg/bg1.jpg') }}">
        <div class="container pt-50 pb-50">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center text-md-start">
                            <h2 class="title">Form Pendaftaran Santri</h2>
                            </div>
                            <div class="col-md-6 text-end">
                            <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                                <div class="breadcrumbs">
                                <span><a href="{{ route('landing') }}">Beranda</a></span>
                                <span><i class="fa fa-angle-right mx-2"></i></span>
                                <span class="active">Register Santri</span>
                                </div>
                            </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form section -->
    <section>
        <div class="container">
            <div class="row">
            <div class="col-md-8 offset-md-2">
                <form method="POST" action="{{ route('register.santri.post') }}" class="register-form">
                @csrf
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

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label>Username</label>
                    <input name="username" class="form-control" type="text" value="{{ old('username') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label>Email</label>
                    <input name="email" class="form-control" type="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label>Password</label>
                    <input name="password" class="form-control" type="password" required>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label>Konfirmasi Password</label>
                    <input name="password_confirmation" class="form-control" type="password" required>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label>Nama Lengkap</label>
                    <input name="nama_lengkap" class="form-control" type="text" value="{{ old('nama_lengkap') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label>Nama Panggilan</label>
                    <input name="nama_panggil" class="form-control" type="text" value="{{ old('nama_panggil') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label>Tanggal Lahir</label>
                    <input name="tanggal_lahir" class="form-control" type="date" value="{{ old('tanggal_lahir') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label>Pendidikan Asal</label>
                    <input name="pendidikan_asal" class="form-control" type="text" value="{{ old('pendidikan_asal') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label>No Telepon</label>
                    <input name="no_telepon" class="form-control" type="text" value="{{ old('no_telepon') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                </div>

                <hr>

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label>Nama Ayah</label>
                    <input name="nama_ayah" class="form-control" type="text" value="{{ old('nama_ayah') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label>Pekerjaan Ayah</label>
                    <input name="pekerjaan_ayah" class="form-control" type="text" value="{{ old('pekerjaan_ayah') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label>No HP Ayah</label>
                    <input name="no_hp_ayah" class="form-control" type="text" value="{{ old('no_hp_ayah') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label>Nama Ibu</label>
                    <input name="nama_ibu" class="form-control" type="text" value="{{ old('nama_ibu') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label>Pekerjaan Ibu</label>
                    <input name="pekerjaan_ibu" class="form-control" type="text" value="{{ old('pekerjaan_ibu') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label>No HP Ibu</label>
                    <input name="no_hp_ibu" class="form-control" type="text" value="{{ old('no_hp_ibu') }}" required>
                    </div>
                </div>

                <div class="tm-sc-button text-end">
                    <button type="submit" class="btn btn-dark btn-theme-colored1 mt-15 px-4">Daftar Sekarang</button>
                </div>

                </form>
            </div>
            </div>
        </div>
        </section>
</div>
@endsection
