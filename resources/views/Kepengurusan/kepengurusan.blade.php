@extends('layouts.App')

@section('title')
Guru
@endsection

@section('content')
<main class="app-main">
    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Data Kepengurusan</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kepengurusan</li>
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
                            <form method="GET" action="{{ route('kepengurusan.index') }}" class="d-flex" role="search" style="max-width: 300px;">
                                <input type="search" name="search" class="form-control form-control-sm me-2" style="width: 200px;"  placeholder="Cari nama kepengurusan..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                                @if(request('search'))
                                    <a href="{{ route('kepengurusan.index') }}" class="btn btn-secondary btn-sm ms-2">Reset</a>
                                @endif
                            </form>

                            <div class="ms-auto">
                                @role('admin')
                                <a href="{{ route('kepengurusan.create') }}" class="btn btn-primary btn-sm">+ Tambah Kepengurusan</a>
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
                                            <th>Jabatan</th>
                                            <th>Mulai</th>
                                            <th>Akhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kepengurusan as $key => $k)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $k->nama }}</td>
                                                <td>{{ $k->jabatan }}</td>
                                                <td>{{ $k->mulai }}</td>
                                                <td>{{ $k->akhir }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $k->id_kepengurusan }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('kepengurusan.edit', $k->id_kepengurusan) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('kepengurusan.destroy', $k->id_kepengurusan) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus Kepengurusan ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data Kepengurusan belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{ $kepengurusan->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- modal detail kepengurusan --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail Kepengurusan</h5>
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
<script>
    $(document).on('click', 'button[data-bs-toggle="modal"]', function() {
        var kepengurusanId = $(this).data('id');
        console.log('Tombol diklik, ID:', kepengurusanId);

        $.ajax({
            url: '/kepengurusan/' + kepengurusanId + '/detail',
            type: 'GET',
            success: function(response) {
                console.log('Response dari server:', response);

                var modalContent = `
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr><th>Nama</th><td>${response.nama}</td></tr>
                            <tr><th>Jabatan</th><td>${response.jabatan}</td></tr>
                            <tr><th>Mulai Jabatan</th><td>${response.mulai}</td></tr>
                            <tr><th>Akhir Jabatan</th><td>${response.akhir}</td></tr>
                        </tbody>
                    </table>
                `;
                $('#modalBody').html(modalContent);
            },
            error: function() {
                alert('Gagal mengambil data detail kepengurusan.');
            }
        });
    });
</script>
@endpush
@endsection