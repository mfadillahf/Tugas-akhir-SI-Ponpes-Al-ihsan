@extends('layouts.auth')

@section('title', 'Register Donatur')
@section('body-class', 'login-page')

@section('content')
<div class="container" style="margin-top: 40px; max-width: 900px;">
    <div class="card p-4 shadow-sm">
        <h2 class="text-center mb-4 text-primary">Register Donatur</h2>

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

        <form method="POST" action="{{ route('register.donatur.post') }}">
            @csrf
            <div class="row gy-3 gx-3">
                <div class="col-12 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>

                <hr class="my-3">

                <div class="col-12 col-md-6">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="form-control" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" class="form-control" required>
                </div>

                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea id="alamat" name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary px-4">Daftar</button>
            </div>
        </form>
    </div>
</div>
@endsection
