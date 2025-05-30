@extends('layouts.App')

@section('title')
Daftar Nilai Santri
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Nilai Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nilai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mb-0 me-auto">Filter Nilai</h3>
                    
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('nilai.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Kelas</label>
                                <select name="id_kelas" class="form-control">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas->id_kelas }}" {{ request('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                            {{ $kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Mapel</label>
                                <select name="id_mapel" class="form-control">
                                    <option value="">Semua Mapel</option>
                                    @foreach($mapelList as $mapel)
                                        <option value="{{ $mapel->id_mapel }}" {{ request('id_mapel') == $mapel->id_mapel ? 'selected' : '' }}>
                                            {{ $mapel->mapel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Tahun Ajaran</label>
                                <input type="text" name="tahun_ajaran" class="form-control" value="{{ request('tahun_ajaran') }}" placeholder="2024/2025">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="btn btn-secondary w-100">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mb-0 me-auto">Daftar Nilai</h3>
                    <a href="{{ route('nilai.create') }}" class="btn btn-primary btn-sm">+ Tambah Nilai</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Santri</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Nilai</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nilaiList as $key => $nl)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $nl->santri->nama_lengkap }}</td>
                                        <td>{{ $nl->santri->kelas->nama_kelas ?? '-' }}</td>
                                        <td>{{ $nl->mapel->mapel }}</td>
                                        <td>{{ $nl->nilai }}</td>
                                        <td>{{ $nl->tahun_ajaran }}</td>
                                        <td>
                                            <a href="{{ route('nilai.edit', $nl->id_nilai) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('nilai.destroy', $nl->id_nilai) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus nilai ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="text-center">Data tidak ditemukan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $nilaiList->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
