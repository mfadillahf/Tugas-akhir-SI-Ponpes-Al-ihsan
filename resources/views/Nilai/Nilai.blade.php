@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts/layoutMaster')

@section('title', 'Data Nilai Santri')

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

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/tables-datatables-nilai.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">
<meta name="user-role" content="{{ Auth::user()->getRoleNames()->first() }}">

<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">

            {{-- Filter hanya untuk guru --}}
            @role('guru')
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Filter Nilai</h3>
                <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                <i class="ri-filter-line me-1"></i> Filter
                </button>
            </div>
            <div class="collapse" id="filterCollapse">
                <div class="card-body border-top">
                <form method="GET" action="{{ route('nilai.index') }}">
                    <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Kelas</label>
                        <select name="id_kelas" class="form-select select2">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id_kelas }}" {{ request('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Mapel</label>
                        <select name="id_mapel" class="form-select select2">
                        <option value="">Semua Mapel</option>
                        @foreach($mapelList as $mapel)
                            <option value="{{ $mapel->id_mapel }}" {{ request('id_mapel') == $mapel->id_mapel ? 'selected' : '' }}>
                            {{ $mapel->mapel }}
                            </option>
                        @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="row g-2">
                        <div class="col">
                            <label class="form-label">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-control" value="{{ request('tahun_ajaran') }}" placeholder="2024/2025">
                        </div>
                        <div class="col-auto d-flex align-items-end gap-1">
                            <button class="btn btn-primary" type="submit">
                            <i class="ri-search-line"></i>
                            </button>
                            <a href="{{ route('nilai.index') }}" class="btn btn-outline-secondary">
                            <i class="ri-refresh-line"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
            @endrole



            {{-- Data Nilai --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h3 class="card-title mb-0">Daftar Nilai Santri</h3>
                    @role('guru')
                    <a href="{{ route('nilai.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line"></i> Tambah Nilai
                    </a>
                    @endrole
                </div>

                <div class="card-datatable table-responsive pt-0">
                    <table class="table table-bordered datatables-basic">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                @role('guru')
                                    <th>Nama Santri</th>
                                    <th>Kelas</th>
                                @endrole
                                <th>Mapel</th>
                                <th>Nilai</th>
                                <th>Tahun Ajaran</th>
                                @role('guru')
                                <th>Aksi</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nilaiList as $key => $nl)
                            <tr>
                                <td>{{ ($nilaiList->firstItem() ?? 0) + $key }}</td>
                                @role('guru')
                                    <td>{{ $nl->santri->nama_lengkap }}</td>
                                    <td>{{ $nl->santri->kelas->nama_kelas ?? '-' }}</td>
                                @endrole
                                <td>{{ $nl->mapel->mapel ?? '-' }}</td>
                                <td>{{ $nl->nilai }}</td>
                                <td>{{ $nl->tahun_ajaran }}</td>
                                @role('guru')
                                <td>
                                    <a href="{{ route('nilai.edit', $nl->id_nilai) }}" class="btn btn-warning btn-sm">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <form action="{{ route('nilai.destroy', $nl->id_nilai) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete-nilai" data-id="{{ $nl->id_nilai }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </td>
                                @endrole
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
