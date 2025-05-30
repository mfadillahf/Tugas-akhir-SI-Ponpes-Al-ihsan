@extends('layouts.App')

@section('title')
Edit Nilai Santri
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Nilai Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('nilai.index') }}">Nilai</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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

            <form action="{{ route('nilai.update', $nilai->id_nilai) }}" method="POST" class="card p-3">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Santri</label>
                    <input type="text" class="form-control" value="{{ $nilai->santri->nama_lengkap }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Kelas</label>
                    <input type="text" class="form-control" value="{{ $nilai->santri->kelas->nama_kelas ?? '-' }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Mapel</label>
                    <input type="text" class="form-control" value="{{ $nilai->mapel->mapel }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Tahun Ajaran</label>
                    <input type="text" class="form-control" value="{{ $nilai->tahun_ajaran }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Nilai</label>
                    <input type="number" name="nilai" class="form-control" value="{{ old('nilai', $nilai->nilai) }}" min="0" max="100" required>
                </div>

                 <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('nilai.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            </form>
        </div>
    </div>
</main>
@endsection
