@extends('layouts/layoutMaster')

@section('title', 'Tambah Agenda')

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
@vite(['resources/assets/js/form-validation-agenda.js'])
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

                <form id="formAgendaCreate" action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data" class="row g-4 needs-validation">
                    @csrf

                    <div class="col-12">
                        <h4 class="fw-bold">Tambah Agenda</h4>
                    </div>

                    {{-- 1. Kategori Agenda --}}
                    <div class="col-12">
                        <h6>1. Kategori Agenda</h6>
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select name="id_jenis_agenda" id="id_jenis_agenda" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Jenis Agenda --</option>
                                @foreach ($jenisAgenda as $ja)
                                <option value="{{ $ja->id_jenis_agenda }}" {{ old('id_jenis_agenda') == $ja->id_jenis_agenda ? 'selected' : '' }}>
                                    {{ $ja->jenis_agenda }}
                                </option>
                                @endforeach
                            </select>
                            <label for="id_jenis_agenda">Jenis Agenda</label>
                        </div>
                    </div>

                    {{-- 2. Informasi Agenda --}}
                    <div class="col-12">
                        <h6 class="mt-2">2. Informasi Agenda</h6>
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul" value="{{ old('judul') }}" required>
                            <label for="judul">Judul</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" style="height: 58px;" required>{{ old('deskripsi') }}</textarea>
                            <label for="deskripsi">Deskripsi</label>
                        </div>
                    </div>

                    {{-- 3. Jadwal --}}
                    <div class="col-12">
                        <h6 class="mt-2">3. Jadwal</h6>
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ old('tanggal_akhir') }}" required>
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
