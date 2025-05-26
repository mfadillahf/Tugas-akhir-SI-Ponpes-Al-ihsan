@extends('layouts.App')

@section('title')
Berita
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
                <div class="col-sm-6"><h3 class="mb-0">Data Berita</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
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
                            <h3 class="card-title mb-0 me-auto">Berita</h3>
                        <a href="{{ route('berita.create') }}" class="btn btn-primary btn-sm">+ Tambah Berita</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>isi</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @forelse ($berita as $key => $ga)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $ga->deskripsi }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/berita/' . $ga->foto) }}" alt="Foto berita" style="max-width: 150px;">
                                                </td>
                                                <td>{{ $ga->tanggal}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-id="{{ $ga->id_berita }}" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('berita.edit', $ga->id_berita) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('berita.destroy', $ga->id_berita) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data berita belum tersedia.</td>
                                            </tr>
                                        @endforelse --}}
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{ $berita->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- modal detail berita --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail berita</h5>
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
        var beritaId = $(this).data('id');
        console.log('Tombol diklik, ID:', beritaId);

        $.ajax({
            url: '/berita/' + beritaId + '/detail',
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
                                <td><img src="${response.foto}" alt="Foto berita" style="max-width: 150px;"></td>
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
                alert('Gagal mengambil data detail berita.');
            }
        });
    });
</script>
@endpush
@endsection