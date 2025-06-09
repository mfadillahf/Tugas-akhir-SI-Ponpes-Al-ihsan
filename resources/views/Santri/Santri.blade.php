@extends('layouts.App')

@section('title')
Santri
@endsection

@section('content')
<main class="app-main">
    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Data Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Santri</li>
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
                        <div class="card-header">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <form method="GET" action="{{ route('santri.index') }}" class="d-flex" role="search" style="max-width: 450px;">
                                    <input type="search" name="search" class="form-control form-control-sm me-2" style="width: 300px;" placeholder="Cari nama, kelas, atau status..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                                    @if(request('search'))
                                        <a href="{{ route('santri.index') }}" class="btn btn-light btn-sm ms-2">Reset</a>
                                    @endif
                                </form>

                                <div class="ms-auto">
                                    @role('admin')
                                    <a href="{{ route('santri.create') }}" class="btn btn-primary btn-sm">+ Tambah Santri</a>
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
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Kelas</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($santri as $key => $s)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $s->nama_lengkap }}</td>
                                                <td>{{ $s->email ?? '-' }}</td>
                                                <td>{{ $s->no_telepon }}</td>
                                                <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                                <td>{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                <td>
                                                    
                                                    @if($s->status == 'santri')
                                                        <span class="badge bg-success">Santri</span>
                                                    @elseif($s->status == 'calon')
                                                        <span class="badge bg-secondary">Calon</span>
                                                    @else
                                                        <span class="badge bg-warning">-</span>
                                                    @endif
                                                    
                                                </td>
                                                
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $s->id_santri }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                        Detail
                                                    </button>
                                                    @if(auth()->user()->hasRole('admin'))
                                                        <a href="{{ route('santri.edit', $s->id_santri) }}" class="btn btn-warning btn-sm">Edit</a>
                                                        <form action="{{ route('santri.destroy', $s->id_santri) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus santri ini?')">Hapus</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Data santri belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{ $santri->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- modal detail santri --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Data Santri akan dimuat di sini -->
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
        var santriId = $(this).data('id');
        console.log('Tombol diklik, ID:', santriId);

        $.ajax({
            url: '/santri/' + santriId + '/detail',
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
                alert('Gagal mengambil data detail santri.');
            }
        });
    });
</script>
@endpush
@endsection


