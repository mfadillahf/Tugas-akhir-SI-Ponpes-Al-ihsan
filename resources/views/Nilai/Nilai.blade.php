@extends('layouts/layoutMaster')

@section('title', 'daftar nilai santri')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Nilai Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nilai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            {{-- Filter hanya untuk guru --}}
            @role('guru')
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mb-0 me-auto">Filter Nilai</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('nilai.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Kelas</label>
                                <select name="id_kelas" class="form-control">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas->id_kelas }}" {{ request('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                            {{ $kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Mapel</label>
                                <select name="id_mapel" class="form-control">
                                    <option value="">Semua Mapel</option>
                                    @foreach($mapelList as $mapel)
                                        <option value="{{ $mapel->id_mapel }}" {{ request('id_mapel') == $mapel->id_mapel ? 'selected' : '' }}>
                                            {{ $mapel->mapel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Tahun Ajaran</label>
                                <input type="text" name="tahun_ajaran" class="form-control" value="{{ request('tahun_ajaran') }}" placeholder="2024/2025">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="btn btn-secondary w-100">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endrole

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mb-0 me-auto">Daftar Nilai</h3>
                    @role('guru')
                        <a href="{{ route('nilai.create') }}" class="btn btn-primary btn-sm">+ Tambah Nilai</a>
                    @endrole
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    @role('guru')
                                        <th>Nama Santri</th>
                                        <th>Kelas</th>
                                    @endrole
                                    <th>Mapel</th>
                                    <th>Nilai</th>
                                    <th>Tahun Ajaran</th>
                                    @role('guru')
                                        <th>Aksi</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nilaiList as $key => $nl)
                                    <tr>
                                        <td>{{ ($nilaiList->firstItem() ?? 0) + $key }}</td>
                                        @role('guru')
                                            <td>{{ $nl->santri->nama_lengkap }}</td>
                                            <td>{{ $nl->santri->kelas->nama_kelas ?? '-' }}</td>
                                        @endrole
                                        <td>{{ $nl->mapel->mapel ?? '-' }}</td>
                                        <td>{{ $nl->nilai }}</td>
                                        <td>{{ $nl->tahun_ajaran }}</td>
                                        @role('guru')
                                        <td>
                                            <a href="{{ route('nilai.edit', $nl->id_nilai) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('nilai.destroy', $nl->id_nilai) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm btn-delete-nilai" data-id="{{ $nl->id_nilai }}">Hapus</button>
                                            </form>
                                        </td>
                                        @endrole
                                    </tr>
                                @empty
                                    <tr><td colspan="{{ Auth::user()->hasRole('guru') ? 7 : 4 }}" class="text-center">Data tidak ditemukan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $nilaiList->links() }}
                </div>
            </div>
        </div>
    </div>
</main>

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

    {{-- SweetAlert konfirmasi hapus nilai --}}
    <script>
        $(document).on('click', '.btn-delete-nilai', function (e) {
            e.preventDefault();
            const nilaiId = $(this).data('id');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data nilai tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        method: 'POST',
                        action: `/nilai/${nilaiId}`
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
