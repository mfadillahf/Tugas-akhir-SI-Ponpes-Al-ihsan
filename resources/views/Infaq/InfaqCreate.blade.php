@extends('layouts.App')

@section('title', 'Tambah Infaq')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tambah Infaq</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('infaq.index') }}">Infaq</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Infaq</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">
                {{-- Tampilkan error validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form class="needs-validation" action="{{ route('infaq.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nominal" class="form-label">Nominal</label>
                            <input type="number" name="nominal" id="nominal" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('infaq.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
