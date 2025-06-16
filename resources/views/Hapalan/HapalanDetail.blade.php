@extends('layouts.App')
@section('title', 'Detail Hapalan')

@section('content')
<div class="container">
    <h3>Detail Hapalan: {{ $hapalan->santri->nama_lengkap ?? '-' }}</h3>
    <p>Guru: {{ $hapalan->guru->nama ?? '-' }}</p>
    <!-- Tombol Buka Modal Tambah -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createDetailModal">
        Tambah Detail
    </button>

    <hr>
    <h5>Riwayat Detail Hapalan</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hapalan->details as $detail)
                <tr>
                    <td>{{ $detail->keterangan }}</td>
                    <td>{{ $detail->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <!-- Tombol Edit Modal -->
                        <button 
                            type="button" 
                            class="btn btn-sm btn-warning btn-edit-detail" 
                            data-id="{{ $detail->id_hapalan_detail }}" 
                            data-keterangan="{{ $detail->keterangan }}"
                            data-action="{{ route('hapalan.detail.update', $detail->id_hapalan_detail) }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#editDetailModal">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('hapalan.detail.destroy', $detail->id_hapalan_detail) }}" method="POST" class="d-inline form-hapus">
                            @csrf
                            @method('DELETE')
                             <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $detail->id_hapalan_detail }}">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('hapalan.index') }}" class="btn btn-secondary mt-3">
    ← Kembali
</a>
</div>

<!-- Modal Tambah Detail -->
<div class="modal fade" id="createDetailModal" tabindex="-1" aria-labelledby="createDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
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
                        <textarea name="keterangan" class="form-control" rows="4" required></textarea>
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

<!-- Modal Edit Detail -->
<div class="modal fade" id="editDetailModal" tabindex="-1" aria-labelledby="editDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
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
                        <textarea name="keterangan" id="edit_keterangan" class="form-control" rows="4" required></textarea>
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
{{-- Notifikasi sukses --}}
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

{{-- Notifikasi error --}}
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

{{-- Isi otomatis saat edit modal --}}
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
</script>

{{-- SweetAlert konfirmasi hapus --}}
<script>
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


