@extends('layouts.App')

@section('title')
Hapalan
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
                <div class="col-sm-6"><h3 class="mb-0">Data Hapalan</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hapalan</li>
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
                            <h3 class="card-title mb-0 me-auto">hapalan</h3>
                        <a href="{{ route('hapalan.create') }}" class="btn btn-primary btn-sm">+ Tambah Hapalan</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Santri</th>
                                            <th>Guru</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($hapalans as $h)
                                            <tr>
                                                <td>{{ $h->santri->nama_lengkap }}</td>
                                                <td>{{ $h->guru->nama }}</td>
                                                <td>{{ $h->keterangan }}</td>
                                                <td>
                                                    <a href="{{ route('hapalan.edit', $h->id_hapalan) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('hapalan.destroy', $h->id_hapalan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="7" class="text-center">Data hapalan belum tersedia.</td>
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
</main>

{{-- modal detail hapalan --}}
{{-- <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail hapalan</h5>
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
                            <tr>
                                <th>Judul</th>
                                <td>${response.judul}</td>
                            </tr>
                            
                            <tr>
                                <th>Jenis hapalan</th>
                                <td>${response.kategori}</td>
                            </tr>

                            <tr>
                                <th>isi</th>
                                <td>${response.isi}</td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td><img src="${response.foto}" alt="Foto hapalan" style="max-width: 150px;"></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>${response.tanggal}</td>
                            </tr>

                            <tr>
                                <th>Penulis</th>
                                <td>${response.penulis}</td>
                            </tr>

                            
                        </tbody>
                `;
                $('#modalBody').html(modalContent);
            },
            error: function() {
                alert('Gagal mengambil data detail hapalan.');
            }
        });
    });
</script>
@endpush --}}
@endsection