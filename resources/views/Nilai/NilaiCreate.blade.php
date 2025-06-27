@extends('layouts/layoutMaster')

@section('title', 'Tambah Nilai Santri')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/jquery/jquery.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/tables-datatables-tambah-nilai.js'])
@endsection
@section('content')
<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Filter form GET --}}
            <form method="GET" action="{{ route('nilai.create') }}" class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Filter Data Nilai</h5>
                </div>
                <div class="card-body border-top">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select id="id_kelas" name="id_kelas" class="form-select select2" required>
                                <option value="">Pilih Kelas</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id_kelas }}" {{ old('id_kelas', $id_kelas) == $kelas->id_kelas ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="id_mapel" class="form-label">Mapel</label>
                            <select id="id_mapel" name="id_mapel" class="form-select select2" required>
                                <option value="">Pilih Mapel</option>
                                @foreach($mapelList as $mapel)
                                    <option value="{{ $mapel->id_mapel }}" {{ old('id_mapel', $id_mapel) == $mapel->id_mapel ? 'selected' : '' }}>
                                        {{ $mapel->mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Form input nilai --}}
            @if($santris->count() > 0)
                <form method="POST" action="{{ route('nilai.store') }}" class="card">
                    @csrf

                    {{-- Hidden input untuk filter --}}
                    <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
                    <input type="hidden" name="id_mapel" value="{{ $id_mapel }}">

                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="card-title mb-0">Input Nilai Santri</h5>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="ri-save-line"></i> Simpan Nilai
                        </button>
                    </div>

                    <div class="card-body border-top">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                <input
                                    type="text"
                                    id="tahun_ajaran"
                                    name="tahun_ajaran"
                                    class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                    placeholder="2024/2025"
                                    value="{{ old('tahun_ajaran', $tahun_ajaran) }}"
                                    required
                                >
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama Santri</th>
                                    <th style="width: 20%;">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($santris as $i => $santri)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $santri->nama_lengkap }}</td>
                                        <td>
                                            <input
                                                type="number"
                                                name="nilai[{{ $santri->id_santri }}]"
                                                class="form-control @error('nilai.' . $santri->id_santri) is-invalid @enderror"
                                                min="0" max="100"
                                                value="{{ old('nilai.' . $santri->id_santri) }}"
                                                required
                                            >
                                            @error('nilai.' . $santri->id_santri)
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            @endif
        </div>
    </div>
</main>
@endsection