@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Detail Hafalan Santri: {{ $hapalan->santri->nama_lengkap }}</h4>

    <a href="{{ route('hapalan.index') }}" class="btn btn-secondary btn-sm mb-3">Kembali</a>

    <!-- Tambah Detail -->
    <form action="{{ route('hapalan.storeDetail', $hapalan->id_hapalan) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="keterangan">Keterangan Hafalan</label>
            <textarea name="keterangan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Tambah</button>
    </form>

    <!-- Tabel Detail -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Keterangan</th>
                <th>Waktu Input</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hapalan->detail as $i => $detail)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $detail->keterangan }}</td>
                <td>{{ $detail->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <a href="{{ route('hapalan.editDetail', $detail->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('hapalan.destroyDetail', $detail->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
