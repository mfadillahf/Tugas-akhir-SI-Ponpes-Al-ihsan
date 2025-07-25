@php use Illuminate\Support\Str; @endphp

@extends('layouts/layoutMaster')

@section('title', 'Data Galeri')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/jquery/jquery.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/tables-datatables-galeri.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">

<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h3 class="card-title mb-0">Data Galeri</h3>
                    @role('admin')
                    <a href="{{ route('galeri.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line"></i> Tambah Galeri
                    </a>
                    @endrole
                </div>

                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($galeri as $key => $ga)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ga->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ Str::limit(strip_tags($ga->deskripsi), 100) }}</td>
                                <td>
                                    @if($ga->foto)
                                        <img src="{{ asset('storage/app/public/galeri/' . $ga->foto) }}" alt="Foto Galeri" class="img-thumbnail" style="max-width: 100px; height: auto;">
                                    @else
                                        <span class="text-muted">foto tidak ada</span>
                                    @endif
                                </td>
                                <td>
									{{ \Carbon\Carbon::parse($ga->tanggal)->locale('id')->translatedFormat('d F Y') }}
								</td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $ga->id_galeri }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        <i class="ri-information-line"></i>
                                    </button>
                                    @role('admin')
                                    <a href="{{ route('galeri.edit', $ga->id_galeri) }}" class="btn btn-warning btn-sm">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <form action="{{ route('galeri.destroy', $ga->id_galeri) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $ga->id_galeri }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                    @endrole
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Modal Detail Galeri --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection