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
                        <li class="breadcrumb-item active">Tambah Infaq</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('infaq.pay') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('infaq.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary ms-2">Lanjut</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
