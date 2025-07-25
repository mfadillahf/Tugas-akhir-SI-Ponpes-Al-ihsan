@extends('layouts/layoutMaster')

@section('title', 'Pembayaran Infaq')

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

@section('page-script')
<!-- Midtrans Snap SDK -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

@vite(['resources/assets/js/front-page-payment-infaq.js'])

@endsection

@section('content')
<main class="app-main">
  <div class="container py-4">
    <div class="card p-3 shadow-sm">
      <div class="row">
        {{-- KIRI: Informasi Pembayaran --}}
        <div class="col-lg-7 border-end p-4">
          <h4 class="mb-2 fw-bold">Informasi Pembayaran</h4>
          <p class="mb-4 text-muted">Periksa kembali detail pembayaran infaq Anda.</p>

          <div class="row g-4">
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" id="nominal" class="form-control" value="Rp {{ number_format($infaq->nominal, 0, ',', '.') }}" readonly>
                <label for="nominal">Nominal</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" id="tanggal" class="form-control" value="{{ \Carbon\Carbon::parse($infaq->tanggal)->translatedFormat('d F Y') }}" readonly>
                <label for="tanggal">Tanggal</label>
              </div>
            </div>

            @if ($infaq->keterangan)
            <div class="col-md-12">
              <div class="form-floating form-floating-outline">
                <input type="text" id="keterangan" class="form-control" value="{{ $infaq->keterangan }}" readonly>
                <label for="keterangan">Keterangan</label>
              </div>
            </div>
            @endif
          </div>
        </div>

        {{-- KANAN: Aksi Pembayaran --}}
        <div class="col-lg-5 p-4">
          <h4 class="mb-3 fw-bold">Aksi Pembayaran</h4>
          <p class="text-muted mb-4">Klik tombol di bawah untuk menyelesaikan proses pembayaran melalui Midtrans.</p>

          <div class="bg-lighter p-4 rounded-3 text-center">
            <h5 class="text-success mb-3">Total Bayar</h5>
            <h2 class="fw-bold mb-4">Rp {{ number_format($infaq->nominal, 0, ',', '.') }}</h2>

            <button id="pay-button"
              class="btn btn-success btn-lg w-100"
              data-snap-token="{{ $snapToken }}"
              data-redirect-url="{{ route('infaq.index') }}">
              Bayar Sekarang
            </button>


            <p class="mt-3 text-muted small">
              Pastikan Anda menekan tombol "Bayar Sekarang" untuk melanjutkan ke halaman Midtrans.
            </p>
            <a href="{{ route('infaq.index') }}" class="btn btn-secondary mt-3 w-100">← Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection