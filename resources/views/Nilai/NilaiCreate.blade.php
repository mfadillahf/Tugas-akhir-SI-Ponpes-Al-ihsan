@extends('layouts.App')

@section('title')
Tambah Nilai
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tambah Nilai Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('nilai.index') }}">Nilai</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="GET" action="{{ route('nilai.create') }}" class="card mb-4 p-3">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select id="id_kelas" name="id_kelas" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id_kelas }}" {{ request('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="id_mapel" class="form-label">Mapel</label>
                        <select id="id_mapel" name="id_mapel" class="form-control" required>
                            <option value="">Pilih Mapel</option>
                            @foreach($mapelList as $mapel)
                                <option value="{{ $mapel->id_mapel }}" {{ request('id_mapel') == $mapel->id_mapel ? 'selected' : '' }}>
                                    {{ $mapel->mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                        <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="form-control" placeholder="2024/2025" value="{{ request('tahun_ajaran') }}" required>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-secondary w-100">Tampilkan</button>
                    </div>
                </div>
            </form>


            @php
                $id_kelas = request('id_kelas');
                $id_mapel = request('id_mapel');
                $tahun_ajaran = request('tahun_ajaran');
                $santris = [];
                if ($id_kelas && $id_mapel && $tahun_ajaran) {
                    $santris = \App\Models\Santri::where('id_kelas', $id_kelas)->get();
                }
            @endphp

            @if(count($santris) > 0)
            <form method="POST" action="{{ route('nilai.store') }}" class="card p-3">
                @csrf
                <input type="hidden" name="id_mapel" value="{{ $id_mapel }}">
                <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
                <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Santri</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($santris as $santri)
                                <tr>
                                    <td>{{ $santri->nama_lengkap }}</td>
                                    <td>
                                        <input type="number" name="nilai[{{ $santri->id_santri }}]" class="form-control" required>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button class="btn btn-success mt-3">Simpan Nilai</button>
            </form>
            @endif
        </div>
    </div>
</main>
@endsection
