@extends('layouts.App')

@section('title', 'Tambah Hapalan')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tambah Hapalan Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.guru') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('hapalan.index') }}">Hapalan</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            {{-- Error session atau validasi --}}
            @if(session('error'))
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

            {{-- Filter kelas --}}
            <form method="GET" action="{{ route('hapalan.create') }}" class="card p-3 mb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="id_kelas" class="form-label">Pilih Kelas</label>
                        <select name="id_kelas" id="id_kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id_kelas }}" {{ $id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-secondary">Tampilkan</button>
                    </div>
                </div>
            </form>

            {{-- Form hapalan dengan tabel santri --}}
            @if($santris->count() > 0)
                <form method="POST" action="{{ route('hapalan.store') }}" class="card p-3">
                    @csrf
                    <input type="hidden" name="id_guru" value="{{ $guru->id_guru }}">
                    <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>Nama Santri</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($santris as $santri)
                                    <tr>
                                        <td>
                                            <input type="radio" name="id_santri" value="{{ $santri->id_santri }}" required>
                                        </td>
                                        <td>{{ $santri->nama_lengkap }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-3">
                        <label for="guru">Guru</label>
                        <input type="text" class="form-control" value="{{ $guru->nama }}" readonly>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('hapalan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Hapalan</button>
                    </div>
                </form>
            @endif

        </div>
    </div>
</main>
@endsection
