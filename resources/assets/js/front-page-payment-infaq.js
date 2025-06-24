'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const payButton = document.getElementById('pay-button');
  const snapToken = payButton.getAttribute('data-snap-token');
  const redirectUrl = payButton.getAttribute('data-redirect-url');

  payButton.onclick = function () {
    snap.pay(snapToken, {
      onSuccess: function (result) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Pembayaran berhasil!',
          timer: 3000,
          showConfirmButton: false
        }).then(() => {
        window.location.href = redirectUrl;
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
        console.log("Popup ditutup.");
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
});
