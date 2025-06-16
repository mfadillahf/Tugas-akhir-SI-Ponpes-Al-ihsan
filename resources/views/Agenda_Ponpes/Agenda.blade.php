@extends('layouts.App')

@section('title')
agenda
@endsection

@section('content')

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Data Agenda</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agenda</li>
                    </ol>
                </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

                <!--begin::Row-->
                <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0 me-auto">Agenda</h3>
                        <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm">+ Tambah Agenda</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($agenda as $key => $ad)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $ad->judul }}</td>
                                                <td>{{ $ad->tanggal_mulai }}</td>
                                                <td>{{ $ad->tanggal_akhir }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $ad->id_agenda }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('agenda.edit', $ad->id_agenda) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('agenda.destroy', $ad->id_agenda) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $ad->id_agenda }}">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data agenda belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{ $agenda->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- modal detail agenda --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                
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

    {{-- AJAX untuk modal detail agenda --}}
    <script>
        $(document).on('click', 'button[data-bs-toggle="modal"]', function () {
            var agendaId = $(this).data('id');

            $.ajax({
                url: '/agenda/' + agendaId + '/detail',
                type: 'GET',
                success: function (response) {
                    var modalContent = `
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th>Judul</th>
                                    <td>${response.judul}</td>
                                </tr>
                                <tr>
                                    <th>Jenis agenda</th>
                                    <td>${response.kategori}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>${response.deskripsi}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>${response.tanggal_mulai}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Akhir</th>
                                    <td>${response.tanggal_akhir}</td>
                                </tr>
                            </tbody>
                        </table>
                    `;
                    $('#modalBody').html(modalContent);
                },
                error: function () {
                    alert('Gagal mengambil data detail agenda.');
                }
            });
        });
    </script>

    {{-- SweetAlert konfirmasi hapus --}}
    <script>
        $(document).on('click', '.btn-delete', function () {
            const agendaId = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        method: 'POST',
                        action: `/agenda/${agendaId}`
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

                    form.appendTo('body').submit();
                }
            });
        });
    </script>
@endpush
@endsection