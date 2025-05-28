@extends('layouts.App')

@section('title', 'Tambah Galeri')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Berita</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Berita</li>
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
                <form class="needs-validation" action="{{ route('berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="col-md-12 mb-3">
                        <label for="id_jenis_berita" class="form-label">Pilih Jenis Berita</label>
                        <select name="id_jenis_berita" id="id_jenis_berita" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jenis Berita --</option>
                            @foreach ($jenisBerita as $jb)
                                <option value="{{ $jb->id_jenis_berita }}" {{ old('id_jenis_berita', $berita->id_jenis_berita) == $jb->id_jenis_berita ? 'selected' : '' }}>
                                    {{ $jb->kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="isi" class="form-label">Isi</label>
                            <textarea class="form-control" name="isi" id="isi" rows="3" required>{{ old('isi', $berita->isi) }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ old('tanggal', $berita->tanggal) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="foto" class="form-label">Ganti Foto (Opsional)</label>
                            <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                            @if ($berita->foto)
                                <div class="mt-2">
                                    <p>Foto Sekarang:</p>
                                    <img src="{{ asset('storage/berita/' . $berita->foto) }}" alt="Foto Galeri" class="img-fluid" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
