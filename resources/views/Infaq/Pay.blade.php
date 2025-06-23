@extends('layouts/layoutMaster')

@section('title', 'Pembayaran Infaq')

@section('content')
<main class="app-main">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Konfirmasi Pembayaran Infaq</h4>
                    </div>
                    <div class="card-body text-center">
                        <p class="fs-5 mb-4">Nominal yang harus dibayar:</p>
                        <h2 class="text-success mb-4">Rp {{ number_format($infaq->nominal, 0, ',', '.') }}</h2>
                        
                        <button id="pay-button" class="btn btn-success btn-lg px-5">
                            <i class="bi bi-credit-card-fill me-2"></i> Bayar Sekarang
                        </button>

                        <p class="mt-3 text-muted small">
                            Pastikan Anda menekan tombol "Bayar Sekarang" untuk melanjutkan proses pembayaran.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script type="text/javascript">
  document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
      onSuccess: function (result) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Pembayaran berhasil!',
          timer: 3000,
          showConfirmButton: false
        }).then(() => {
          window.location.href = "{{ route('infaq.index') }}";
        });
      },
      onPending: function (result) {
        Swal.fire({
          icon: 'info',
          title: 'Menunggu Pembayaran',
          text: 'Silakan selesaikan pembayaran Anda.',
          timer: 3000,
          showConfirmButton: false
        });
      },
      onError: function (result) {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat memproses pembayaran.',
          timer: 3000,
          showConfirmButton: false
        });
      },
      onClose: function () {
        Swal.fire({
          icon: 'info',
          title: 'Dibatalkan',
          text: 'Anda menutup pembayaran sebelum menyelesaikannya.',
          timer: 3000,
          showConfirmButton: false
        });
      }
    });
  };
</script>
@endpush

@endsection
