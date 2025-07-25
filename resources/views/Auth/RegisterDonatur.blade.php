@extends('layouts.landing')

@section('title', 'Register Donatur')

@section('content')
<div class="main-content-area">
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" style="padding-top: 120px;" data-tm-bg-img="{{ asset('images/bg/bg1.jpg') }}">
        <div class="container pt-50 pb-50">
            <div class="section-content">
				<div class="row">
				  <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
					<h2 class="title mb-2">Form Pendaftaran Donatur</h2>
				  </div>
				  <div class="col-12 col-md-6 text-center text-md-end">
					<nav class="breadcrumbs d-inline-block" role="navigation" aria-label="Breadcrumbs">
					  <div class="breadcrumbs">
						<span><a href="{{ route('landing') }}">Beranda</a></span>
						<span><i class="fa fa-angle-right mx-2"></i></span>
						<span class="active">Pendaftaran Donatur</span>
					  </div>
					</nav>
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
                    <form method="POST" action="{{ route('register.donatur.post') }}" class="register-form">
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
                                <input name="email" class="form-control" type="email" value="{{ old('email') }}">
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
                                <input name="nama" class="form-control" type="text" value="{{ old('nama') }}" required>
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
