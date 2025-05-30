@extends('layouts.App')

@section('title', 'Edit Mapel')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Mapel</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('mapel.index') }}">Mata Pelajaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Mapel</li>
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
                <form class="needs-validation" action="{{ route('mapel.update', $mapel->id_mapel) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-12 mb-3">
                        <label for="id_guru" class="form-label">Pilih Guru</label>
                        <select name="id_guru" id="id_guru" class="form-select" required>
                            <option value="" disabled>-- Pilih Guru --</option>
                            @foreach ($guru as $gm)
                                <option value="{{ $gm->id_guru }}" {{ old('id_guru', $mapel->id_guru) == $gm->id_guru ? 'selected' : '' }}>
                                    {{ $gm->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="mapel" class="form-label">Mapel</label>
                            <input type="text" class="form-control" id="mapel" name="mapel" value="{{ old('mapel', $mapel->mapel) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="2">{{ old('deskripsi', $mapel->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('mapel.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
