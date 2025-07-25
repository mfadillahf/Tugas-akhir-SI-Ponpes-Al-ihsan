@extends('layouts/layoutMaster')

@section('title', 'Edit Berita')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/tagify/tagify.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/tagify/tagify.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/form-validation-berita.js'])
@endsection

@section('content')
<main class="app-main">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">

                {{-- Error validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formBeritaEdit" action="{{ route('berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data" class="row g-4 needs-validation">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <h4 class="fw-bold">Edit Berita</h4>
                    </div>

                    {{-- 1. Kategori Berita --}}
                    <div class="col-12">
                        <h6>1. Kategori Berita</h6>
                        <hr />
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select name="id_jenis_berita" id="id_jenis_berita" class="form-select" required>
                                <option value="" disabled>-- Pilih Jenis Berita --</option>
                                @foreach ($jenisBerita as $jb)
                                    <option value="{{ $jb->id_jenis_berita }}" {{ old('id_jenis_berita', $berita->id_jenis_berita) == $jb->id_jenis_berita ? 'selected' : '' }}>
                                        {{ $jb->kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 2. Isi Berita --}}
                    <div class="col-12">
                        <h6 class="mt-2">2. Isi Berita</h6>
                        <hr />
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul" value="{{ old('judul', $berita->judul) }}" required>
                            <label for="judul">Judul</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea class="form-control" name="isi" id="isi" rows="5" required>{{ old('isi', $berita->isi) }}</textarea>
                    </div>

                    {{-- 3. Informasi Tambahan --}}
                    <div class="col-12">
                        <h6 class="mt-2">3. Informasi Tambahan</h6>
                        <hr />
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', $berita->tanggal) }}" required>
                            <label for="tanggal">Tanggal</label>
                        </div>
                    </div>

                    {{-- 4. Foto --}}
                    <div class="col-12">
                        <h6 class="mt-2">4. Foto</h6>
                        <hr />
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                            <label for="foto">Ganti Foto (Opsional)</label>
                        </div>
                        @if ($berita->foto)
                            <div class="mt-2">
                                <p class="mb-1">Foto Saat Ini:</p>
                                <img src="{{ asset('storage/app/public/berita/' . $berita->foto) }}" alt="Foto Berita" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection
