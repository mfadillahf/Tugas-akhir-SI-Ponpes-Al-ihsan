@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts/layoutMaster')

@section('title', 'Data Hapalan Santri')

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
@vite(['resources/assets/js/tables-datatables-hapalan-detail.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">
<meta name="user-role" content="{{ Auth::user()->getRoleNames()->first() }}">

<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="card-title mb-0">Riwayat Detail Hapalan : {{ $hapalan->santri->nama_lengkap ?? '-' }}</h5>
                        @role('guru')
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createDetailModal">
                            <i class="ri-add-line"></i>Tambah Detail
                        </button>
                        @endrole
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered datatables-basic">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                    @role('guru')
                                    <th>Aksi</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hapalan->details as $i => $detail)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $detail->keterangan }}</td>
                                        <td><span class="badge bg-secondary">{{ $detail->created_at->format('d M Y H:i') }}</span></td>
                                        @role('guru')
                                        <td>
                                            <form action="{{ route('hapalan.detail.destroy', $detail->id_hapalan_detail) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex gap-1">
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-warning btn-sm btn-edit-detail"
                                                        data-id="{{ $detail->id_hapalan_detail }}"
                                                        data-keterangan="{{ $detail->keterangan }}"
                                                        data-action="{{ route('hapalan.detail.update', $detail->id_hapalan_detail) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDetailModal">
                                                        <i class="ri-edit-line"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm btn-delete" type="submit">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        @endrole
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('hapalan.index') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Modal Tambah Detail --}}
<div class="modal fade" id="createDetailModal" tabindex="-1" aria-labelledby="createDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-block">
        <form method="POST" action="{{ route('hapalan.detail.store', $hapalan->id_hapalan) }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDetailLabel">Tambah Detail Hapalan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" style="height: 200px;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Detail --}}
<div class="modal fade" id="editDetailModal" tabindex="-1" aria-labelledby="editDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-block">
        <form method="POST" id="formEditDetail">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDetailLabel">Edit Detail Hapalan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="edit_keterangan" class="form-control" style="height: 200px;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
