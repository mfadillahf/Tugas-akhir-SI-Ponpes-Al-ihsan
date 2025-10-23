@extends('layouts/layoutMaster')

@section('title', 'QRIS Donasi')

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

        <form action="{{ route('qris.update', $qris->id ?? 0) }}" 
        method="POST" 
        enctype="multipart/form-data" 
        id="formQris"
        data-mode="edit"
        class="form-floating-outline needs-validation"
        novalidate>
        @csrf
        @method('PUT')

        <!-- Judul -->
        <input type="hidden" name="judul" value="QRIS Donasi">
        <input type="hidden" name="deskripsi" value="Gambar QRIS Donasi Pondok Pesantren">

        <!-- Gambar -->
        <div class="card-body text-center">
            <h4 class="fw-bold mb-4">QRIS Infaq</h4>

            <img
            src="{{ $qris && $qris->gambar ? asset('storage/qris/' . $qris->gambar) : asset('assets/img/placeholders/placeholder.png') }}"
            alt="QRIS Infaq"
            class="rounded-3 mb-3 mx-auto d-block"
            id="previewQrisImg"
            style="width: 100%; max-width: 400px; height: auto; object-fit: cover;" />

        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
            <button type="button" class="btn btn-primary mb-2" onclick="document.getElementById('gambar').click()">Upload Foto Baru</button>
            <button type="button" class="btn btn-outline-danger mb-2 reset-image-btn">Reset Gambar</button>
        </div>
            <input type="file" id="gambar" name="gambar" class="d-none">
            <p class="mb-0 text-muted">Format JPG/PNG. Max 2MB.</p>
        </div>

        <div class="card-body pt-0">
            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

    </div>
    </div>
</div>

<script>
  // Preview gambar baru
  document.getElementById('gambar').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
      document.getElementById('previewQrisImg').src = URL.createObjectURL(file);
    }
  });

  // Reset gambar
  document.querySelector('.reset-image-btn').addEventListener('click', function() {
    document.getElementById('previewQrisImg').src = "{{ $qris && $qris->gambar ? asset('storage/qris/' . $qris->gambar) : asset('assets/img/placeholders/placeholder.png') }}";
    document.getElementById('gambar').value = '';
  });
</script>
@endsection
