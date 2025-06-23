@extends('layouts/layoutMaster')

@section('title', 'Tambah Kepengurusan')

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
@vite(['resources/assets/js/form-validation-kepengurusan.js'])
@endsection

@section('content')
<main class="app-main">
    <div class="col-12">
        <div class="card shadow-sm">
        <div class="card-body">

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            <form id="formKepengurusanCreate" action="{{ route('kepengurusan.store') }}" method="POST" enctype="multipart/form-data" class="row g-4 needs-validation">
            @csrf

            <div class="col-12">
                <h4 class="fw-bold">Tambah Kepengurusan</h4>
            </div>

            {{-- 1. Data Pribadi --}}
            <div class="col-12">
                <h6>1. Data Pribadi</h6>
                <hr />
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}" required>
                <label for="nama">Nama</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan" value="{{ old('jabatan') }}" required>
                <label for="jabatan">Jabatan</label>
                </div>
            </div>

            {{-- 2. Masa Jabatan --}}
            <div class="col-12">
                <h6 class="mt-2">2. Masa Jabatan</h6>
                <hr />
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="date" id="mulai" name="mulai" class="form-control" value="{{ old('mulai') }}" required>
                <label for="mulai">Mulai Jabatan</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                <input type="date" id="akhir" name="akhir" class="form-control" value="{{ old('akhir') }}" required>
                <label for="akhir">Akhir Jabatan</label>
                </div>
            </div>

            {{-- 3. Foto --}}
            <div class="col-12">
                <h6 class="mt-2">3. Foto</h6>
                <hr />
            </div>

            <div class="col-md-12">
                <div class="form-floating form-floating-outline">
                <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                <label for="foto">Upload Foto</label>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('kepengurusan.index') }}" class="btn btn-secondary">← Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>

        </div>
        </div>
    </div>
</main>
@endsection
