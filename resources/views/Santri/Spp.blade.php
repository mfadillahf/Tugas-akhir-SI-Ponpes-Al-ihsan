@extends('layouts/layoutMaster')

@section('title', 'Data SPP Santri')

{{-- Vendor Styles --}}
@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
    
])
@endsection

{{-- Vendor Scripts --}}
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/jquery/jquery.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/tables-datatables-spp.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">

<div class="app-content pt-3">
    <div class="container-fluid">

        {{-- Filter --}}
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title mb-0">Filter Data SPP</h4>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('spp.index') }}" class="row g-3">

                    {{-- Filter Kelas --}}
                    <div class="col-md-4">
                        <label class="form-label">Kelas</label>
                        <select name="kelas" class="form-select">
                            <option value="">- Pilih Kelas -</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id_kelas }}" 
                                    {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Bulan --}}
                    <div class="col-md-4">
                        <label class="form-label">Bulan</label>
                        <select name="bulan" class="form-select">
                            <option value="">- Pilih Bulan -</option>
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ date("F", mktime(0,0,0,$i,1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    {{-- Filter Tahun --}}
                    <div class="col-md-4">
                        <label class="form-label">Tahun</label>
                        <select name="tahun" class="form-select">
                            <option value="">- Pilih Tahun -</option>
                            @for ($t = date('Y'); $t >= 2020; $t--)
                                <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                                    {{ $t }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-primary"><i class="ri-search-line"></i> Tampilkan</button>
                    </div>

                </form>
            </div>
        </div>

        {{-- Jika belum ada filter --}}
        @if(!request()->has('kelas') && !request()->has('bulan') && !request()->has('tahun'))
            <div class="alert alert-info text-center">
                <strong>Silakan pilih filter kelas, bulan, dan tahun untuk melihat data SPP.</strong>
            </div>
        @else

        {{-- Tabel Data --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Data SPP Santri</h4>
            </div>

            <div class="card-datatable table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Kelas</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($spp as $key => $row)
                        <tr>
                            <td>{{ $key + $spp->firstItem() }}</td>
                            <td>{{ $row->santri->nama_lengkap }}</td>
                            <td>{{ $row->santri->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ date("F", mktime(0,0,0,$row->bulan,1)) }}</td>
                            <td>{{ $row->tahun }}</td>

                            <td>
                                @if($row->status == 'lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-danger">Belum</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('spp.edit', [
                                    'id' => $row->id_spp,
                                    'kelas' => request('kelas'),
                                    'bulan' => request('bulan'),
                                    'tahun' => request('tahun'),
                                ]) }}" class="btn btn-warning btn-sm">
                                    <i class="ri-edit-line"></i>
                                </a>
{{-- 
                                <a href="{{ route('spp.show', $row->id_spp) }}" class="btn btn-info btn-sm">
                                    <i class="ri-information-line"></i>
                                </a> --}}
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-2">
                    {{ $spp->links() }}
                </div>
            </div>
        </div>

        @endif

    </div>
</div>
@endsection
