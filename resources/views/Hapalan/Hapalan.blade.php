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

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

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
                                                <td>{{ $h->hapalan->nama_lengkap ?? '-' }}</td>
                                                <td>{{ $h->guru->nama ?? '-' }}</td>
                                                <td><button type="button" class="btn btn-info btn-sm" data-id="{{ $h->id_hapalan }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                        Detail
                                                    </button></td>

                                                @role('guru')
                                                <td>
                                                    <a href="{{ route('hapalan.edit', $h->id_hapalan) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('hapalan.destroy', $h->id_hapalan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">Hapus</button>
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
<script>
    $(document).on('click', 'button[data-bs-toggle="modal"]', function() {
        var hapalanId = $(this).data('id');
        console.log('Tombol diklik, ID:', hapalanId);

        $.ajax({
            url: '/hapalan/' + hapalanId + '/detail',
            type: 'GET',
            success: function(response) {
                console.log('Response dari server:', response);

                var modalContent = `
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr><th>Nama Lengkap</th><td>${response.nama_lengkap}</td></tr>
                            <tr><th>Email</th><td>${response.email}</td></tr>
                            <tr><th>No Telepon</th><td>${response.no_telepon}</td></tr>
                            <tr><th>Jenis Kelamin</th><td>${response.jenis_kelamin}</td></tr>
                            <tr><th>Status</th><td>${response.status}</td></tr>
                            <tr><th>Alamat</th><td>${response.alamat}</td></tr>
                            <tr><th>Tanggal Lahir</th><td>${response.tanggal_lahir}</td></tr>
                            <tr><th>Nama Panggil</th><td>${response.nama_panggil}</td></tr>
                            <tr><th>Pendidikan Asal</th><td>${response.pendidikan_asal}</td></tr>
                            <tr><th>Nama Ayah</th><td>${response.nama_ayah}</td></tr>
                            <tr><th>Pekerjaan Ayah</th><td>${response.pekerjaan_ayah}</td></tr>
                            <tr><th>No HP Ayah</th><td>${response.no_hp_ayah}</td></tr>
                            <tr><th>Nama Ibu</th><td>${response.nama_ibu}</td></tr>
                            <tr><th>Pekerjaan Ibu</th><td>${response.pekerjaan_ibu}</td></tr>
                            <tr><th>No HP Ibu</th><td>${response.no_hp_ibu}</td></tr>
                            <tr><th>Kelas</th><td>${response.kelas}</td></tr>
                        </tbody>
                    </table>
                `;
                $('#modalBody').html(modalContent);
            },
            error: function() {
                alert('Gagal mengambil data detail hapalan.');
            }
        });
    });
</script>
@endpush
@endsection
