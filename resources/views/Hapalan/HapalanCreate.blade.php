@extends('layouts.App')

@section('title', 'Tambah Galeri')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tambah Hapalan</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('galeri.index') }}">Hapalan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Hapalan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">
                {{-- Tampilkan error validation --}}
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
                <form action="{{ route('hapalan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Santri</label>
                        <select name="id_santri" class="form-control" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santris as $sh)
                                <option value="{{ $sh->id_santri }}">{{ $sh->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Guru</label>
                        <select name="id_guru" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach($gurus as $gh)
                                <option value="{{ $gh->id_guru }}">{{ $gh->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" required></textarea>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('hapalan.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
