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
@vite(['resources/assets/js/tables-datatables-hapalan.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">
<meta name="user-role" content="{{ Auth::user()->getRoleNames()->first() }}">


<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h3 class="card-title mb-0">Data Hapalan</h3>
                    @role('guru')
                    <a href="{{ route('hapalan.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line"></i> Tambah Hapalan
                    </a>
                    @endrole
                </div>

                <div class="card-datatable table-responsive pt-0">
                    <table class="table table-bordered datatables-basic">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Santri</th>
                                <th>Guru</th>
								<th>Juz</th>
        						<th>Level Hafalan</th>
                                <th>Keterangan</th>
                                @role('guru')
                                <th>Aksi</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hapalans as $key => $h)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $h->santri->nama_lengkap ?? '-' }}</td>
                                <td>{{ $h->guru->nama ?? '-' }}</td>
								<td>
   		 							{{ $h->juz ? 'Juz ' . $h->juz : '-' }}
								</td>
								<td>{{ $h->levelHapalan->nama_level ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('hapalan.showDetail', $h->id_hapalan) }}" class="btn btn-info btn-sm">
                                        <i class="ri-information-line"></i></a>
                                </td>
                                @role('guru')
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ 									$h->id_hapalan }}">
   					 				<i class="ri-edit-line"></i>
									</button>
                                    <form action="{{ route('hapalan.destroy', $h->id_hapalan) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $h->id_hapalan }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </td>
                                @endrole
                            </tr>
							<!-- Modal -->
<div class="modal fade" id="editModal{{ $h->id_hapalan }}" tabindex="-1" aria-labelledby="editModalLabel{{ $h->id_hapalan }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('hapalan.updateJuzLevel', $h->id_hapalan) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $h->id_hapalan }}">Edit Juz & Level Hafalan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="juz{{ $h->id_hapalan }}" class="form-label">Juz</label>
                        <input type="text" class="form-control" name="juz" id="juz{{ $h->id_hapalan }}" value="{{ $h->juz }}">
                    </div>
                    <div class="mb-3">
                        <label for="level{{ $h->id_hapalan }}" class="form-label">Level Hafalan</label>
                        <select class="form-select" name="id_level_hapalan" id="level{{ $h->id_hapalan }}">
                            <option value="">-- Pilih Level --</option>
                            @foreach ($levelHapalan as $level)
                                <option value="{{ $level->id_level_hapalan }}" {{ $h->id_level_hapalan == $level->id_level_hapalan ? 'selected' : '' }}>
                                    {{ $level->nama_level }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
