@extends('layouts/layoutMaster')

@section('title', 'Edit Nilai Santri')

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
@vite(['resources/assets/js/form-validation-nilai.js'])
@endsection

@section('content')
<main class="app-main">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">

                {{-- Error Validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formNilaiEdit" action="{{ route('nilai.update', $nilai->id_nilai) }}" method="POST" class="row g-4 needs-validation">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <h4 class="fw-bold">Edit Nilai Santri</h4>
                    </div>

                    {{-- 1. Informasi Santri --}}
                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" value="{{ $nilai->santri->nama_lengkap }}" readonly disabled>
                            <label>Nama Santri</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" value="{{ $nilai->santri->kelas->nama_kelas ?? '-' }}" readonly disabled>
                            <label>Kelas</label>
                        </div>
                    </div>

                    {{-- 2. Mata Pelajaran --}}
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" value="{{ $nilai->mapel->mapel }}" readonly disabled>
                            <label>Mata Pelajaran</label>
                        </div>
                    </div>

                    {{-- 3. Tahun Ajaran --}}
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran', $nilai->tahun_ajaran) }}" required>
                            <label>Tahun Ajaran</label>
                        </div>
                    </div>

                    {{-- 4. Nilai --}}
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="number" name="nilai" class="form-control" min="0" max="100" value="{{ old('nilai', $nilai->nilai) }}" required>
                            <label>Nilai</label>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('nilai.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection
