@extends('layouts.App')

@section('title')
donatur
@endsection

@section('content')
<main class="app-main">
    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Data donatur</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">donatur</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="app-content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <form method="GET" action="{{ route('donatur.index') }}" class="d-flex" role="search" style="max-width: 300px;">
                                <input type="search" name="search" class="form-control form-control-sm me-2"  placeholder="Cari nama donatur..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                                @if(request('search'))
                                    <a href="{{ route('donatur.index') }}" class="btn btn-secondary btn-sm ms-2">Reset</a>
                                @endif
                            </form>

                            <div class="ms-auto">
                                @role('admin')
                                <a href="{{ route('donatur.create') }}" class="btn btn-primary btn-sm">+ Tambah Donatur</a>
                                @endrole
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Telpon</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($donatur as $key => $d)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $d->nama }}</td>
                                                <td>{{ $d->alamat ?? '-' }}</td>
                                                <td>{{ $d->no_telepon }}</td>
                                                <td>{{ $d->email ?? '-' }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $d->id_donatur }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('donatur.edit', $d->id_donatur) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('donatur.destroy', $d->id_donatur) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $d->id_donatur }}">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data donatur belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{ $donatur->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- modal detail donatur --}}
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
    {{-- SweetAlert Notifikasi Sukses --}}
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

    {{-- SweetAlert Notifikasi Error --}}
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

    {{-- AJAX untuk Modal Detail Donatur --}}
    <script>
        $(document).on('click', 'button[data-bs-toggle="modal"]', function () {
            var donaturId = $(this).data('id');
            $.ajax({
                url: '/donatur/' + donaturId + '/detail',
                type: 'GET',
                success: function (response) {
                    var modalContent = `
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr><th>Nama</th><td>${response.nama}</td></tr>
                                <tr><th>No Telepon</th><td>${response.no_telepon}</td></tr>
                                <tr><th>Email</th><td>${response.email}</td></tr>
                                ${response.nip ? `<tr><th>NIP</th><td>${response.nip}</td></tr>` : ''}
                                ${response.tanggal_lahir ? `<tr><th>Tanggal Lahir</th><td>${response.tanggal_lahir}</td></tr>` : ''}
                                ${response.jenis_kelamin ? `<tr><th>Jenis Kelamin</th><td>${response.jenis_kelamin}</td></tr>` : ''}
                            </tbody>
                        </table>
                    `;
                    $('#modalBody').html(modalContent);
                },
                error: function () {
                    alert('Gagal mengambil data detail donatur.');
                }
            });
        });
    </script>

    {{-- SweetAlert Konfirmasi Hapus --}}
    <script>
        $(document).on('click', '.btn-delete', function () {
            const donaturId = $(this).data('id');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data donatur akan terhapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        method: 'POST',
                        action: `/donatur/${donaturId}`
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
