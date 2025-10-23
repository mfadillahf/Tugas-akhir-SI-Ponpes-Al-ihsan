@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts/layoutMaster')

@section('title', 'Data Hapalan Kitab Santri')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/jquery/jquery.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/tables-datatables-hapalan-kitab.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">
<meta name="user-role" content="{{ Auth::user()->getRoleNames()->first() }}">

<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="card-title mb-0">
                Riwayat Hapalan Kitab : {{ $hapalan->santri->nama_lengkap ?? '-' }}
                </h5>

                @role('guru')
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createKitabModal">
                <i class="ri-add-line"></i> Tambah Hapalan Kitab
                </button>
                @endrole
            </div>

            <div class="table-responsive">
                <table class="table table-bordered datatables-basic">
                <thead class="table-light">
                    <tr>
                    <th>No</th>
                    <th>Keterangan 1</th>
                    <th>Keterangan 2</th>
                    <th>Keterangan 3</th>
                    <th>Keterangan 4</th>
                    <th>Waktu</th>
                    @role('guru')
                    <th>Aksi</th>
                    @endrole
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hapalan->kitab as $i => $kitab)
                    <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $kitab->keterangan_1 }}</td>
                    <td>{{ $kitab->keterangan_2 }}</td>
                    <td>{{ $kitab->keterangan_3 }}</td>
                    <td>{{ $kitab->keterangan_4 }}</td>
                    <td><span class="badge bg-secondary">{{ $kitab->waktu ? \Carbon\Carbon::parse($kitab->waktu)->format('d M Y') : '-' }}</span></td>

                    @role('guru')
                    <td>
                        <form action="{{ route('hapalan.kitab.destroy', $kitab->id_hapalan_kitab) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex gap-1">
                            <button 
                            type="button"
                            class="btn btn-warning btn-sm btn-edit-kitab"
                            data-id="{{ $kitab->id_hapalan_kitab }}"
                            data-k1="{{ $kitab->keterangan_1 }}"
                            data-k2="{{ $kitab->keterangan_2 }}"
                            data-k3="{{ $kitab->keterangan_3 }}"
                            data-k4="{{ $kitab->keterangan_4 }}"
                            data-waktu="{{ $kitab->waktu }}"
                            data-action="{{ route('hapalan.kitab.update', $kitab->id_hapalan_kitab) }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editKitabModal">
                            <i class="ri-edit-line"></i>
                            </button>
                            <button class="btn btn-danger btn-sm btn-delete" type="submit">
                            <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                        </form>
                    </td>
                    @endrole
                    </tr>
                    @empty
                    @endforelse
                </tbody>
                </table>
            </div>

            <a href="{{ route('hapalan.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            </div>
        </div>
        </div>
    </div>
</main>

{{-- Modal Tambah Kitab --}}
<div class="modal fade" id="createKitabModal" tabindex="-1" aria-labelledby="createKitabLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered d-block">
    <form method="POST" action="{{ route('hapalan.kitab.store', $hapalan->id_hapalan) }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createKitabLabel">Tambah Hapalan Kitab</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            @for ($i = 1; $i <= 4; $i++)
              <div class="col-md-6">
                <label class="form-label">Keterangan {{ $i }}</label>
                <textarea name="keterangan_{{ $i }}" class="form-control" style="height: 100px;" required></textarea>
              </div>
            @endfor
            <div class="col-md-6">
              <label class="form-label">Waktu</label>
              <input type="date" name="waktu" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Modal Edit Kitab --}}
<div class="modal fade" id="editKitabModal" tabindex="-1" aria-labelledby="editKitabLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered d-block">
    <form method="POST" id="formEditKitab">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editKitabLabel">Edit Hapalan Kitab</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            @for ($i = 1; $i <= 4; $i++)
              <div class="col-md-6">
                <label class="form-label">Keterangan {{ $i }}</label>
                <textarea id="edit_keterangan_{{ $i }}" name="keterangan_{{ $i }}" class="form-control" style="height: 100px;" required></textarea>
              </div>
            @endfor
            <div class="col-md-6">
              <label class="form-label">Waktu</label>
              <input type="date" id="edit_waktu" name="waktu" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const editButtons = document.querySelectorAll('.btn-edit-kitab');
  editButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const form = document.getElementById('formEditKitab');
      form.action = this.dataset.action;
      for (let i = 1; i <= 4; i++) {
        document.getElementById('edit_keterangan_' + i).value = this.dataset['k' + i];
      }
      document.getElementById('edit_waktu').value = this.dataset.waktu;
    });
  });
});
</script>
@endsection
