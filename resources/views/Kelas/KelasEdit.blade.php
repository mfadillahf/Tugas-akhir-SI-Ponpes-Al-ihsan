@extends('layouts/layoutMaster')

@section('title', 'Edit Kelas')

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
@vite(['resources/assets/js/form-validation-kelas.js'])
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

                <form id="formKelasEdit" action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST" class="row g-4 needs-validation">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <h4 class="fw-bold">Edit Kelas</h4>
                    </div>

                    {{-- 1. Data Kelas --}}
                    <div class="col-12">
                        <h6>1. Data Kelas</h6>
                        <hr />
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="nama_kelas" name="nama_kelas" class="form-control" placeholder="Nama Kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                            <label for="nama_kelas">Nama Kelas</label>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection
