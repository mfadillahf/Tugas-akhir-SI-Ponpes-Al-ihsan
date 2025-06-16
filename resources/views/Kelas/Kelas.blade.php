@extends('layouts.App')

@section('title', 'Kelas')

@section('content')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Data Kelas</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0 me-auto">Kelas</h3>
                            <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm">+ Tambah Kelas</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kelas as $index => $k)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $k->nama_kelas }}</td>
                                                <td>
                                                    <a href="{{ route('kelas.edit', $k->id_kelas) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('kelas.destroy', $k->id_kelas) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kelas ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $k->id_kelas }}">Hapus</button>
                                                    </form>
                                                </td>  
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Data kelas kosong.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            {{-- {{ $kelas->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

@push('scripts')

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

<script>
    $(document).on('click', '.btn-delete', function () {
        var kelasId = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data kelas tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Buat form dan submit secara otomatis
                const form = $('<form>', {
                    method: 'POST',
                    action: `/kelas/${kelasId}`
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

                form.appendTo('body').submit();
            }
        });
    });
</script>
@endpush

@endsection
