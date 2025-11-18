@extends('layouts/layoutMaster')

@section('title', 'Edit SPP')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
])
@endsection

@section('page-script')
@vite(['resources/assets/js/form-validation-spp.js'])
@endsection

@section('content')
<main class="app-main">

    <div class="col-12">
        <div class="card shadow-sm">
        <div class="card-body">

            {{-- Error --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('spp.update', $spp->id_spp) }}" method="POST" class="row g-4 needs-validation">
                @csrf
                @method('PUT')

                <div class="col-12">
                    <h4 class="fw-bold">Edit Pembayaran SPP</h4>
                    <p class="text-muted">Santri: <strong>{{ $spp->santri->nama_lengkap }}</strong></p>
                </div>

                {{-- Bulan --}}
                @php
                    $bulanList = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember',
                    ];
                @endphp

        <div class="col-md-6">
            <div class="form-floating form-floating-outline">
                <input 
                    type="text" 
                    name="bulan" 
                    class="form-control" 
                    value="{{ $bulanList[$spp->bulan] ?? '' }}"
                    disabled
                    placeholder="Bulan"
                    readonly
                >
                <label for="bulan">Bulan</label>
            </div>
        </div>

                {{-- Tahun --}}
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input 
                            type="number"
                            class="form-control"
                            value="{{ $spp->tahun }}"
                            disabled
                        >
                        <input type="hidden" name="tahun" value="{{ $spp->tahun }}">
                        <label for="tahun">Tahun</label>
                    </div>
                </div>

                {{-- Status --}}
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                    <select name="status" class="form-select" required>
                        <option value="belum" {{ $spp->status == 'belum' ? 'selected' : '' }}>Belum</option>
                        <option value="lunas" {{ $spp->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    <label for="status">Status</label>
                        <label for="status">Status</label>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('spp.index', [
                            'kelas' => request('kelas'), 
                            'bulan' => request('bulan'), 
                            'tahun' => request('tahun'),
                            'status' => request('status')
                        ]) }}" class="btn btn-secondary">← Kembali</a>

                    <input type="hidden" name="filter_kelas" value="{{ request('kelas') }}">
                    <input type="hidden" name="filter_bulan" value="{{ request('bulan') }}">
                    <input type="hidden" name="filter_tahun" value="{{ request('tahun') }}">
                    <input type="hidden" name="filter_status" value="{{ request('status') }}">

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
        </div>
    </div>

</main>
@endsection
