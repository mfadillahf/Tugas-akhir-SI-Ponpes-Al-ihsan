@extends('layouts/layoutMaster')

@section('title', 'Tambah Infaq')

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
@vite(['resources/assets/js/form-validation-infaq.js'])
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

                <form action="{{ route('infaq.store') }}" method="POST" class="row g-4 needs-validation" enctype="multipart/form-data">
                    @csrf

                    <div class="col-12">
                        <h4 class="fw-bold">Tambah Infaq</h4>
                    </div>

                    {{-- 1. Informasi Infaq --}}
                    <div class="col-12">
                        <h6>1. Informasi Infaq</h6>
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Nominal" value="{{ old('nominal') }}" required>
                            <label for="nominal">Nominal</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                            <label for="tanggal">Tanggal</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" value="{{ old('keterangan') }}">
                            <label for="keterangan">Keterangan</label>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="foto" class="form-label">Foto Bukti Transfer</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                    </div>

                    <!-- Tampilan gambar QRIS yang bisa diklik -->
                    <div class="mb-3 text-center">
                        <label class="form-label d-block">Scan QRIS untuk Infaq</label>
                        <img src="{{ asset('images/qris.jpg') }}"
                            alt="QRIS Infaq"
                            style="max-width: 300px; cursor: pointer;"
                            class="img-fluid rounded shadow-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#qrisModal">
                    </div>

                    {{-- Tombol --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('infaq.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Lanjut</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Modal Bootstrap untuk menampilkan QRIS besar -->
<div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-light">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="qrisModalLabel">QRIS Infaq</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('images/qris.jpg') }}" alt="QRIS Besar" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>
@endsection