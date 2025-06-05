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
                                            <th>Santri</th>
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
                                                <td>{{ $h->keterangan }}</td>

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
@endsection
