@extends('layouts/layoutMaster')

@section('title', 'Tambah Mapel')

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
@vite(['resources/assets/js/form-validation-mapel.js'])
@endsection

@section('content')
<main class="app-main">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formMapelCreate" class="row g-4 needs-validation" action="{{ route('mapel.store') }}" method="POST">
                    @csrf

                    <div class="col-12">
                        <h4 class="fw-bold">Tambah Mata Pelajaran</h4>
                    </div>

                    <!-- Guru -->
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select name="id_guru" id="id_guru" class="form-select select2" required>
                                <option value="" disabled selected>-- Pilih Guru --</option>
                                @foreach ($guru as $gm)
                                    <option value="{{ $gm->id_guru }}" {{ old('id_guru') == $gm->id_guru ? 'selected' : '' }}>
                                        {{ $gm->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Nama Mapel -->
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" id="mapel" name="mapel" value="{{ old('mapel') }}" placeholder="Nama Mapel" required>
                            <label for="mapel">Nama Mapel</label>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Mata Pelajaran" style="height: 100px;" required>{{ old('deskripsi') }}</textarea>
                            <label for="deskripsi">Deskripsi</label>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('mapel.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection
