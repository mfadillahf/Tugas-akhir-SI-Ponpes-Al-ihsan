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

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

                <!--begin::Row-->
                <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0 me-auto">Mapel</h3>
                            <a href="#" class="btn btn-primary btn-sm">+ Tambah Mapel</a>
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
                                {{-- @foreach($mapels as $m)
                                    <tr>
                                        <td>{{ $m->mapel }}</td>
                                        <td>{{ $m->guru->nama ?? '-' }}</td>
                                        <td>{{ $m->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('mapel.edit', $m->id_mapel) }}">Edit</a>
                                            <form action="{{ route('mapel.destroy', $m->id_mapel) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach --}}
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{-- Kalau kamu pakai pagination: --}}
                            {{-- {{ $mapel->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection