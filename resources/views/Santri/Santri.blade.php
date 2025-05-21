@extends('layouts.App')

@section('title')
Santri
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
                <div class="col-sm-6"><h3 class="mb-0">Data Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Santri</li>
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
                            <h3 class="card-title mb-0 me-auto">Santri</h3>
                            <a href="{{ route('santri.create') }}" class="btn btn-primary btn-sm">+ Tambah Santri</a>
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
                                    {{-- @forelse ($santri as $key => $s)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $s->nama_lengkap }}</td>
                                            <td>{{ $s->email }}</td>
                                            <td>{{ $s->no_telepon }}</td>
                                            <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                            <td>{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>
                                                @if($s->status == 'aktif')
                                                    <span class="badge bg-success">Aktif</span>
                                                @elseif($s->status == 'nonaktif')
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @else
                                                    <span class="badge bg-warning">-</span>
                                                @endif --}}
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('santri.edit', $s->id_santri) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('santri.destroy', $s->id_santri) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    {{-- @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Data santri belum tersedia.</td>
                                        </tr>
                                    @endforelse --}}
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{-- Kalau kamu pakai pagination: --}}
                            {{-- {{ $santri->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection