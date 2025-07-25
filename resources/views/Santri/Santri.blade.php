@extends('layouts/layoutMaster')

@section('title', 'Data Santri')

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
@vite(['resources/assets/js/tables-datatables-santri.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">

<main class="app-main">
<!-- Main Content -->
    <div class="app-content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h3 class="card-title mb-0">Data Santri</h3>
                @role('admin')
                <a href="{{ route('santri.create') }}" class="btn btn-primary btn-sm">
                    <i class="ri-add-line"></i> Tambah Santri
                </a>
                @endrole
            </div>
            <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-bordered">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Kelas</th>
					<th>Tahun Ajaran</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($santri as $key => $s)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $s->nama_lengkap }}</td>
                    <td>{{ $s->email ?? '-' }}</td>
                    <td>{{ $s->no_telepon }}</td>
                    <td>{{ $s->status === 'calon' ? '-' : ($s->kelas->nama_kelas ?? '-') }}</td>
					<td>{{ $s->status === 'calon' ? '-' : ($s->tahunAjaran->tahun_ajaran ?? '-') }}</td>

                    <td>{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>
                    @if($s->status == 'santri')
                        <span class="badge bg-success">Santri</span>
                    @elseif($s->status == 'calon')
                        <span class="badge bg-secondary">Calon</span>
                    @else
                        <span class="badge bg-warning">-</span>
                    @endif
                    </td>
                    <td>
                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $s->id_santri }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                        <i class="ri-information-line"></i></button>
                    @role('admin')
                    <a href="{{ route('santri.edit', $s->id_santri) }}" class="btn btn-warning btn-sm">
                        <i class="ri-edit-line"></i></a>
                    <form action="{{ route('santri.destroy', $s->id_santri) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $s->id_santri }}">
                            <i class="ri-delete-bin-line"></i></button>
                    </form>
                    @endrole
                    </td>
                </tr>
                @empty
                @endforelse
                </tbody>
            </table>
            </div>

            {{-- {{ $santri->links() }} --}}
        </div>
        </div>
    </div>
</main>

{{-- modal detail santri --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Data Santri akan dimuat di sini -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
