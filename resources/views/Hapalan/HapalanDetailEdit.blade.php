@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Keterangan Hafalan</h4>

    <form action="{{ route('hapalan.updateDetail', $detail->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" required>{{ $detail->keterangan }}</textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Simpan</button>
        <a href="{{ route('hapalan.showDetail', $detail->id_hapalan) }}" class="btn btn-secondary mt-2">Batal</a>
    </form>
</div>
@endsection
