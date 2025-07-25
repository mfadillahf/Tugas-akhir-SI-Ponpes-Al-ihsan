@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts/layoutMaster')

@section('title', 'Data Infaq')

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
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
'resources/assets/vendor/libs/spinkit/spinkit.scss'

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
@vite(['resources/assets/js/tables-datatables-infaq.js'])
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalImage = document.getElementById('modalImage');

        document.querySelectorAll('img[data-bs-toggle="modal"]').forEach(img => {
            img.addEventListener('click', function() {
                const src = this.getAttribute('data-src');
                modalImage.setAttribute('src', src);
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // isi otomatis form modal saat tombol edit diklik
        document.querySelectorAll('.btn-edit-nominal').forEach(function(button) {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const nominal = this.dataset.nominal;
                const form = document.getElementById('formEditNominal');
                const inputNominal = document.getElementById('nominalInput');

                // set nominal value
                inputNominal.value = nominal;

                // set action form
                form.action = `/infaq/${id}/update-nominal`;
            });
        });
    });
</script>
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
                    <h3 class="card-title mb-0">Data Infaq</h3>
                    @role('donatur')
                    <a href="{{ route('infaq.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line"></i> Tambah Infaq
                    </a>
                    @endrole
                </div>

                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Donatur</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Bukti Transfer</th>
                                <th>Status</th>
                                @role('admin')
                                <th>Aksi</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($infaqs as $key => $infaq)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $infaq->donatur->nama ?? 'Tidak diketahui' }}</td>
                                <td>Rp {{ number_format($infaq->nominal, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($infaq->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
                                <td>{{ $infaq->keterangan }}</td>
                                <td>
                                    @if($infaq->foto)
                                    <img src="{{ asset('storage/app/public/infaq/' . $infaq->foto) }}"
                                        alt="Foto Infaq"
                                        style="max-width: 100px; height: 100px; cursor: pointer;"
                                        class="img-thumbnail"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalGambar"
                                        data-src="{{ asset('storage/app/public/infaq/' . $infaq->foto) }}">

                                    @else
                                    <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td>
                                    @if($infaq->status === 'paid')
                                    <span class="badge bg-success">Diterima</span>
                                    @elseif($infaq->status === 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($infaq->status === 'failed')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @else
                                    <span class="badge bg-secondary">{{ ucfirst($infaq->status) }}</span>
                                    @endif
                                </td>
                                @role('admin')
                                <td>
									<button type="button"
										class="btn btn-warning btn-sm btn-edit-nominal"
										data-bs-toggle="modal"
										data-bs-target="#editNominalModal"
										data-id="{{ $infaq->id_infaq }}"
										data-nominal="{{ $infaq->nominal }}">
										<i class="ri-edit-line"></i>
									</button>
									<form action="{{ route('infaq.destroy', $infaq->id_infaq) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $infaq->id_infaq }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                    @if($infaq->status === 'pending')
                                    <form action="{{ route('infaq.terima', $infaq->id_infaq) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm btn-terima">
											<i class="ri-check-line me-1"></i>Terima</button>
                                    </form>
                                    <form action="{{ route('infaq.tolak', $infaq->id_infaq) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm btn-tolak">
											<i class="ri-close-line me-1"></i>Tolak</button>
                                    </form>
                                    @else
                                    @endif
                                </td>
                                @endrole
                            </tr>
                            @empty
                            <p>data tidak tersedia</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Gambar -->
<div class="modal fade" id="modalGambar" tabindex="-1" aria-labelledby="modalGambarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Preview Gambar" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Nominal -->
<div class="modal fade" id="editNominalModal" tabindex="-1" aria-labelledby="editNominalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEditNominal" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editNominalModalLabel">Edit Nominal Infaq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nominalInput" class="form-label">Nominal</label>
                        <input type="number" class="form-control" id="nominalInput" name="nominal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection