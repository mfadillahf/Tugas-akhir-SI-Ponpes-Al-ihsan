@extends('layouts.App')

@section('title')
Galeri
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
                <div class="col-sm-6"><h3 class="mb-0">Data Galeri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
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
                            <h3 class="card-title mb-0 me-auto">Galeri</h3>
                        <a href="{{ route('galeri.create') }}" class="btn btn-primary btn-sm">+ Tambah Galeri</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Deskripsi</th>
                                        <th>Foto</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($galeri as $key => $ga)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $ga->deskripsi }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/galeri/' . $ga->foto) }}" alt="Foto Galeri" style="max-width: 150px;">
                                                </td>
                                                <td>{{ $ga->tanggal}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $ga->id_galeri }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('galeri.edit', $ga->id_galeri) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('galeri.destroy', $ga->id_galeri) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus galeri ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data galeri belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{-- {{ $galeri->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- modal detail galeri --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail galeri</h5>
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
        var galeriId = $(this).data('id');
        console.log('Tombol diklik, ID:', galeriId);

        $.ajax({
            url: '/galeri/' + galeriId + '/detail',
            type: 'GET',
            success: function(response) {
                console.log('Response dari server:', response);

                var modalContent = `
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <th>Deskripsi</th>
                                <td>${response.deskripsi}</td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td><img src="${response.foto}" alt="Foto Galeri" style="max-width: 150px;"></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>${response.tanggal}</td>
                            </tr>
                        </tbody>
                `;
                $('#modalBody').html(modalContent);
            },
            error: function() {
                alert('Gagal mengambil data detail galeri.');
            }
        });
    });
</script>
@endpush
@endsection