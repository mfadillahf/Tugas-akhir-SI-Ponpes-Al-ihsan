@extends('layouts/layoutMaster')

@section('title', 'Tambah Hapalan Santri')

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
@vite(['resources/assets/js/form-validation-hapalan.js'])
@endsection

@section('content')
<main class="app-main">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
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

        {{-- Form filter kelas --}}
        <h5 class="my-4">Pilih Kelas</h5>
        <form method="GET" action="{{ route('hapalan.create') }}" class="row g-4 mb-4">
            <div class="col-sm-10 col-8">
                <div class="form-floating form-floating-outline position-relative">
                <select name="id_kelas" id="id_kelas" class="form-select select2" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelasList as $kelas)
                    <option value="{{ $kelas->id_kelas }}" {{ $id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-sm-2 col-4 d-grid">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
        </form>

                {{-- Form hapalan --}}
                @if($santris->count() > 0)
                <form id="formHapalanCreate" class="row g-4 needs-validation" method="POST" action="{{ route('hapalan.store') }}">
                    @csrf

                    <input type="hidden" name="id_guru" value="{{ $guru->id_guru }}">
                    <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">

                    <div class="col-12">
                        <h4 class="fw-bold">Tambah Hapalan Santri</h4>
                    </div>

                    {{-- Tabel Santri --}}
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Pilih</th>
                                        <th>Nama Santri</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($santris as $santri)
                                        <tr>
                                            <td style="width: 70px;">
                                                <input type="radio" name="id_santri" value="{{ $santri->id_santri }}" required>
                                            </td>
                                            <td>{{ $santri->nama_lengkap }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Guru --}}
                    <input type="hidden" name="id_guru" value="{{ $guru->id_guru }}">

                    {{-- <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" value="{{ $guru->nama }}" readonly disabled>
                            <label>Guru</label>
                        </div>
                    </div> --}}

                    {{-- Tombol --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('hapalan.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Hapalan</button>
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</main>
@endsection
