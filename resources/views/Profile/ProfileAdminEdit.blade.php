@extends('layouts/layoutMaster')

@section('title', 'Edit Profil Admin')

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
@vite(['resources/assets/js/pages-profile-admin-edit.js'])
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card mb-6">
      <!-- Account -->
      <div class="card-header">
        <h5 class="card-title mb-0">Ganti Username atau Password</h5>
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

        <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}"enctype="multipart/form-data" class="row g-4 needs-validation">
          @csrf
          <div class="row mt-1 g-5">
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="username" name="username" value="{{ old('username', $profile->username) }}" autofocus required />
                <label for="username">Username</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin ubah" />
                <label for="password">Password Baru</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                <label for="password_confirmation">Konfirmasi Password</label>
              </div>
            </div>
          </div>

          <div class="mt-6 d-flex justify-content-end gap-2">
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">← Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
