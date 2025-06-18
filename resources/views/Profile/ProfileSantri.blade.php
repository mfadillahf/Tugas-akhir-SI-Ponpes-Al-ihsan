@extends('layouts.App')

@section('title', 'Profil Santri')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Profil Santri</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.santri') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">

                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Nama Lengkap</th><td>{{ $profile->nama_lengkap }}</td></tr>
                        <tr><th>Nama Panggilan</th><td>{{ $profile->nama_panggil }}</td></tr>
                        <tr><th>Tanggal Lahir</th><td>{{ $profile->tanggal_lahir }}</td></tr>
                        <tr><th>Jenis Kelamin</th><td>{{ $profile->jenis_kelamin }}</td></tr>
                        <tr><th>Pendidikan Asal</th><td>{{ $profile->pendidikan_asal }}</td></tr>
                        <tr><th>Alamat</th><td>{{ $profile->alamat }}</td></tr>
                        <tr><th>No Telepon</th><td>{{ $profile->no_telepon }}</td></tr>
                        <tr><th>Email</th><td>{{ $profile->email }}</td></tr>
                        <tr><th>Nama Ayah</th><td>{{ $profile->nama_ayah }}</td></tr>
                        <tr><th>Pekerjaan Ayah</th><td>{{ $profile->pekerjaan_ayah }}</td></tr>
                        <tr><th>No HP Ayah</th><td>{{ $profile->no_hp_ayah }}</td></tr>
                        <tr><th>Nama Ibu</th><td>{{ $profile->nama_ibu }}</td></tr>
                        <tr><th>Pekerjaan Ibu</th><td>{{ $profile->pekerjaan_ibu }}</td></tr>
                        <tr><th>No HP Ibu</th><td>{{ $profile->no_hp_ibu }}</td></tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
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
@endpush
@endsection
