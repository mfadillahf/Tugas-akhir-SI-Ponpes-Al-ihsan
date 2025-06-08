@extends('layouts.App')

@section('title')
Infaq
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
                <div class="col-sm-6"><h3 class="mb-0">Data Infaq</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Infaq</li>
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
                            <h3 class="card-title mb-0 me-auto">Infaq</h3>
                        @role('donatur')
                        <a href="{{ route('infaq.create') }}" class="btn btn-primary btn-sm">+ Tambah Infaq</a>
                        @endrole
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Donatur</th>
                                        <th>nominal</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($infaqs as $key => $infaq)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $infaq->donatur->nama ?? 'Tidak diketahui' }}</td>
                                                <td>Rp {{ number_format($infaq->nominal, 0, ',', '.') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($infaq->tanggal)->format('d M Y') }}</td>
                                                <td>{{ $infaq->keterangan }}</td>
                                                <td>
                                                    @if($infaq->status === 'paid')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @elseif($infaq->status === 'pending')
                                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                                    @elseif($infaq->status === 'failed')
                                                        <span class="badge bg-danger">Gagal</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($infaq->status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Data infaq belum tersedia.</td>
                                            </tr>
                                        @endforelse
                                </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{-- {{ $infaq->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- modal detail infaq --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail infaq</h5>
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
        var infaqId = $(this).data('id');
        console.log('Tombol diklik, ID:', infaqId);

        $.ajax({
            url: '/infaq/' + infaqId + '/detail',
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
                                <th>Jenis infaq</th>
                                <td>${response.kategori}</td>
                            </tr>

                            <tr>
                                <th>isi</th>
                                <td>${response.isi}</td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td><img src="${response.foto}" alt="Foto infaq" style="max-width: 150px;"></td>
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
                alert('Gagal mengambil data detail infaq.');
            }
        });
    });
</script>
@endpush
@endsection