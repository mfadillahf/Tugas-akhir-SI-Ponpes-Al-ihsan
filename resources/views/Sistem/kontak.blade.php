@extends('layouts/layoutMaster')

@section('title', 'Kontak Pondok Pesantren')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
    ])
@endsection

@section('page-script')
@vite(['resources/assets/js/pages-kontak.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <form action="{{ route('kontak.update', $kontak->id_kontak ?? 0) }}"
                method="POST"
                id="formKontak"
                data-mode="edit"
                class="form-floating-outline needs-validation"
                novalidate>
                @csrf
                @method('PUT')

                <div class="card-body text-center">
                    <h4 class="fw-bold mb-4">Edit Kontak Pondok Pesantren</h4>
                </div>

                <div class="card-body pt-0">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="url" name="tiktok" id="tiktok" class="form-control"
                            placeholder="https://tiktok.com/"
                            value="{{ old('tiktok', $kontak->tiktok ?? '') }}">
                        <label for="tiktok">Tiktok</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="url" name="facebook" id="facebook" class="form-control"
                            placeholder="https://facebook.com/"
                            value="{{ old('facebook', $kontak->facebook ?? '') }}">
                        <label for="facebook">Facebook</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="url" name="instagram" id="instagram" class="form-control"
                            placeholder="https://instagram.com/"
                            value="{{ old('instagram', $kontak->instagram ?? '') }}">
                        <label for="instagram">Instagram</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" name="whatsapp" id="whatsapp"
                            class="form-control" placeholder="+62xxx"
                            value="{{ old('whatsapp', $kontak->whatsapp ?? '') }}">
                        <label for="whatsapp">Nomor WhatsApp</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="email@example.com"
                            value="{{ old('email', $kontak->email ?? '') }}">
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="url" name="youtube" id="youtube" class="form-control"
                            placeholder="https://youtube.com/"
                            value="{{ old('youtube', $kontak->youtube ?? '') }}">
                        <label for="youtube">YouTube</label>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
