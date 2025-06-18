@extends('layouts.App')

@section('title', 'Detail Hapalan')

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Detail Hapalan</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('hapalan.index') }}">Hapalan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="fw-bold mb-1">Detail Hapalan: {{ $hapalan->santri->nama_lengkap ?? '-' }}</div>

                        <div class="fw-bold mb-1">Guru: {{ $hapalan->guru->nama ?? '-' }}</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Riwayat Detail Hapalan</h5>
                        @role('guru')
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createDetailModal">
                            <i class="fas fa-plus-circle"></i> Tambah Detail
                        </button>
                        @endrole
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50%">Keterangan</th>
                                    <th style="width: 25%">Waktu</th>
                                    <th style="width: 25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hapalan->details as $detail)
                                    <tr>
                                        <td>{{ $detail->keterangan }}</td>
                                        <td><span class="badge bg-secondary">{{ $detail->created_at->format('d M Y H:i') }}</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button 
                                                    type="button" 
                                                    class="btn btn-warning btn-sm me-1 btn-edit-detail"
                                                    data-id="{{ $detail->id_hapalan_detail }}"
                                                    data-keterangan="{{ $detail->keterangan }}"
                                                    data-action="{{ route('hapalan.detail.update', $detail->id_hapalan_detail) }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editDetailModal">
                                                    <i class="fas fa-edit"></i> edit
                                                </button>

                                                @role('guru')
                                                <form action="{{ route('hapalan.detail.destroy', $detail->id_hapalan_detail) }}" method="POST" class="form-hapus d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $detail->id_hapalan_detail }}">delete
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                @endrole
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Belum ada detail hapalan.</td>
                                    </tr>
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

@push('scripts')
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.btn-edit-detail');
        const editForm = document.getElementById('formEditDetail');
        const keteranganInput = document.getElementById('edit_keterangan');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const keterangan = this.getAttribute('data-keterangan');
                const action = this.getAttribute('data-action');

                keteranganInput.value = keterangan;
                editForm.action = action;
            });
        });
    });

    // SweetAlert hapus
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.form-hapus');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data detail hapalan tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
