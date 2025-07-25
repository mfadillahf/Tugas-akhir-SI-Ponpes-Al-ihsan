@extends('layouts/layoutMaster')

@section('title', 'Tambah Pengeluaran')

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

                <form id="formKelasCreate" action="{{ route('pengeluaran.store') }}" method="POST" class="row g-4 needs-validation">
                    @csrf

                    <div class="col-12">
                        <h4 class="fw-bold">Tambah Pengeluaran</h4>
                    </div>

                    {{-- 1. Data Pengeluaran --}}
                    <div class="col-12">
                        <h6>1. Data Pengeluaran</h6>
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                            <label for="tanggal">Tanggal</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Nominal" value="{{ old('nominal') }}" required>
                            <label for="nominal">Nominal</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" value="{{ old('keterangan') }}">
                            <label for="keterangan">Keterangan</label>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection