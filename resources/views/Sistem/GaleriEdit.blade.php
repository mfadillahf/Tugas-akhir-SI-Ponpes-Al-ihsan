@extends('layouts/layoutMaster')

@section('title', 'Edit Galeri')

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
@vite(['resources/assets/js/form-validation-galeri.js'])
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

                <form id="formGaleriEdit" action="{{ route('galeri.update', $galeri->id_galeri) }}" method="POST" enctype="multipart/form-data" class="row g-4 needs-validation">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <h4 class="fw-bold">Edit Galeri</h4>
                    </div>

                    {{-- 1. Kategori --}}
                    <div class="col-12">
                        <h6>1. Kategori</h6>
                        <hr />
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select name="kategori_galeri_id" id="kategori_galeri_id" class="form-select" required>
                                <option value="" disabled>-- Pilih Kategori --</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_galeri_id', $galeri->kategori_galeri_id) == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 2. Deskripsi --}}
                    <div class="col-12">
                        <h6 class="mt-2">2. Deskripsi</h6>
                        <hr />
                    </div>
                    <div class="col-md-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" required>{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                    </div>

                    {{-- 3. Informasi Tambahan --}}
                    <div class="col-12">
                        <h6 class="mt-2">3. Informasi Tambahan</h6>
                        <hr />
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', $galeri->tanggal) }}" required>
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

                        @if ($galeri->foto)
                            <div class="mt-3">
                                <p>Foto Saat Ini:</p>
                                <img src="{{ asset('storage/galeri/' . $galeri->foto) }}" alt="Foto Galeri" class="img-fluid" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('galeri.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection
