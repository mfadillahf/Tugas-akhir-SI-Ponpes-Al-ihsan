@extends('layouts.App')

@section('title')
Hapalan
@endsection

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Data Hapalan</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hapalan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0 me-auto">Daftar Hapalan</h3>

                            @role('guru')
                            <a href="{{ route('hapalan.create') }}" class="btn btn-primary btn-sm">+ Tambah Hapalan</a>
                            @endrole
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>hapalan</th>
                                            <th>Guru</th>
                                            <th>Keterangan</th>

                                            @role('guru')
                                            <th>Aksi</th>
                                            @endrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($hapalans as $h)
                                            <tr>
                                                <td>{{ $h->santri->nama_lengkap ?? '-' }}</td>
                                                <td>{{ $h->guru->nama ?? '-' }}</td>
                                                <td>
                                                <a href="{{ route('hapalan.showDetail', $h->id_hapalan) }}" class="btn btn-info btn-sm">Detail</a>
                                                </td>

                                                @role('guru')
                                                <td>
                                                    {{-- <a href="{{ route('hapalan.edit', $h->id_hapalan) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                                                    <form action="{{ route('hapalan.destroy', $h->id_hapalan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $h->id_hapalan }}">Hapus</button>
                                                    </form>
                                                </td>
                                                @endrole
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Data hapalan belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $hapalans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- modal detail hapalan --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail Hapalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Data hapalan akan dimuat di sini -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
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

    {{-- SweetAlert konfirmasi hapus hapalan --}}
    <script>
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            const hapalanId = $(this).data('id');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data hapalan tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        method: 'POST',
                        action: `/hapalan/${hapalanId}`
                    });

                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: '{{ csrf_token() }}'
                    }));

                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_method',
                        value: 'DELETE'
                    }));

                    $('body').append(form);
                    form.submit();
                }
            });
        });
    </script>
@endpush

@endsection
