@extends('layouts/layoutMaster')

@section('title', 'Tentang Pesantren')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/pages-tentang-ponpes.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">

        <form action="{{ route('tentang.update', $tentang->id ?? 0) }}" 
        method="POST" 
        enctype="multipart/form-data" 
        id="formTentang" 
        data-mode="edit"
        class="form-floating-outline needs-validation"
        novalidate>
            @csrf
            @method('PUT')

            <!-- Judul + Preview Gambar -->
            <div class="card-body text-center">
            <h4 class="fw-bold mb-4">Edit Tentang Pondok Pesantren</h4>

            <img
                src="{{ $tentang && $tentang->gambar ? asset('storage/tentang/' . $tentang->gambar) : asset('assets/img/placeholders/placeholder.png') }}"
                alt="Foto Pesantren"
                class="rounded-3 mb-3 mx-auto d-block"
                id="previewTentangImg"
                style="width: 100%; max-width: 500px; height: auto; object-fit: cover;" />

            <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                <button type="button" class="btn btn-primary mb-2" onclick="document.getElementById('gambar').click()">Upload Foto Baru</button>
                <button type="button" class="btn btn-outline-danger mb-2 reset-image-btn">Reset Gambar</button>
            </div>
            <input type="file" id="gambar" name="gambar" class="d-none">
            <p class="mb-0 text-muted">Format JPG/PNG. Max 2MB.</p>
            </div>

            <!-- Form Edit -->
            <div class="card-body pt-0">
            <div class="form-floating form-floating-outline mb-4">
                <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul"
                    value="{{ old('judul', $tentang->judul ?? '') }}" required>
                <label for="judul">Judul</label>
            </div>

            <div class="form-floating form-floating-outline mb-4">
                <textarea class="form-control" name="deskripsi" id="deskripsi" style="height: 150px" required>{{ old('deskripsi', $tentang->deskripsi ?? '') }}</textarea>
                <label for="deskripsi">Deskripsi</label>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
