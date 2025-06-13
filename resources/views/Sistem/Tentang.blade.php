@extends('layouts.App')

@section('title')
Tentang
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Data Tentang</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tentang</li>
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
                            <h3 class="card-title mb-0 me-auto">Tentang</h3>
                            @role('admin')
                            <a href="{{ route('tentang.create') }}" class="btn btn-primary btn-sm">+ Tambah Tentang</a>
                            @endrole
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tentang as $key => $t)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $t->judul }}</td>
                                                <td style="max-width: 250px; word-break: break-word;">
                                                    {{ Str::limit(strip_tags($t->deskripsi), 100) }}
                                                </td>
                                                <td>
                                                    @if($t->gambar)
                                                        <img src="{{ asset('storage/tentang/' . $t->gambar) }}" alt="gambar" style="max-width: 150px;">
                                                    @else
                                                        gambar tidak tersedia
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('tentang.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('tentang.destroy', $t->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Belum ada data tentang.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{-- Pagination --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
