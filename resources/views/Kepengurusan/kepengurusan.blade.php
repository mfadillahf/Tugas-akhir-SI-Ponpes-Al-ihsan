@extends('layouts/layoutMaster')

@section('title', 'Data Kepengurusan')

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
@vite(['resources/assets/js/tables-datatables-kepengurusan.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">

<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h3 class="card-title mb-0">Data Kepengurusan</h3>
            @role('admin')
            <a href="{{ route('kepengurusan.create') }}" class="btn btn-primary btn-sm">
                <i class="ri-add-line"></i> Tambah Kepengurusan
            </a>
            @endrole
            </div>

            <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-bordered">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Mulai</th>
                    <th>Akhir</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($kepengurusan as $key => $k)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                    @if($k->foto)
                        <img src="{{ asset('storage/kepengurusan/' . $k->foto) }}" alt="Foto Kepengurusan" class="img-thumbnail" style="max-width: 80px; height: auto;">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                    </td>
                    <td>{{ $k->nama }}</td>
                    <td>{{ $k->jabatan }}</td>
                    <td>{{ $k->mulai }}</td>
                    <td>{{ $k->akhir }}</td>
                    <td>
                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $k->id_kepengurusan }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                        <i class="ri-eye-line"></i>
                    </button>
                    @role('admin')
                    <a href="{{ route('kepengurusan.edit', $k->id_kepengurusan) }}" class="btn btn-warning btn-sm">
                        <i class="ri-edit-line"></i>
                    </a>
                    <form action="{{ route('kepengurusan.destroy', $k->id_kepengurusan) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $k->id_kepengurusan }}">
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

{{-- Modal Detail Kepengurusan --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Detail Kepengurusan</h5>
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
