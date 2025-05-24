@extends('layouts.App')

@section('title', 'Edit Kepengurusan')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Edit Kepengurusan</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/kepengurusan">Kepengurusan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Kepengurusan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="card card-info card-outline mb-4 rounded-3 shadow-sm">
            <div class="card-body">
                {{-- Error Validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="needs-validation" action="{{ route('kepengurusan.update', $kepengurusan->id_kepengurusan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama', $kepengurusan->nama ?? '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" value="{{ old('jabatan', $kepengurusan->jabatan) }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="mulai" class="form-label">Mulai Jabatan</label>
                            <input type="date" class="form-control" name="mulai" value="{{ old('mulai', $kepengurusan->mulai) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="akhir" class="form-label">Akhir Jabatan</label>
                            <input type="date" class="form-control" name="akhir" value="{{ old('akhir', $kepengurusan->akhir) }}" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('kepengurusan.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
