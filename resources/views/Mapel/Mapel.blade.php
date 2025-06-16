@extends('layouts.App')

@section('title')
Mapel
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
                <div class="col-sm-6"><h3 class="mb-0">Data Mapel</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mapel</li>
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
                <!--begin::Row-->
                <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0 me-auto">Mapel</h3>
                        <a href="{{ route('mapel.create') }}" class="btn btn-primary btn-sm">+ Tambah Mapel</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Mapel</th>
                                        <th>Guru</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($mapel as $key => $m)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $m->mapel }}</td>
                                                <td>{{ $m->guru->nama ?? '-' }}</td>
                                                <td>{{ $m->deskripsi }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $m->id_mapel }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('mapel.edit', $m->id_mapel) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('mapel.destroy', $m->id_mapel) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $m->id_mapel }}">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data mapel belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{ $mapel->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- modal detail mapel --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail donatur</h5>
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

{{-- AJAX untuk modal detail --}}
<script>
    $(document).on('click', 'button[data-bs-toggle="modal"]', function() {
        var mapelId = $(this).data('id');

        $.ajax({
            url: '/mapel/' + mapelId + '/detail',
            type: 'GET',
            success: function(response) {
                var modalContent = `
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <th>Mapel</th>
                                <td>${response.mapel}</td>
                            </tr>
                            <tr>
                                <th>Guru</th>
                                <td>${response.guru.nama ?? '-'}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>${response.deskripsi}</td>
                            </tr>
                        </tbody>
                    </table>
                `;
                $('#modalBody').html(modalContent);
            },
            error: function() {
                alert('Gagal mengambil data detail mapel.');
            }
        });
    });
</script>

{{-- SweetAlert konfirmasi hapus --}}
<script>
    $(document).on('click', '.btn-delete', function () {
        const mapelId = $(this).data('id');

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
                    action: `/mapel/${mapelId}`
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