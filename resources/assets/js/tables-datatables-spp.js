'use strict';

document.addEventListener('DOMContentLoaded', function () {
  // Notifikasi SweetAlert2 dari session
  const flashSuccess = document.querySelector('meta[name="flash-success"]');
  const flashError = document.querySelector('meta[name="flash-error"]');
  if (flashSuccess?.content) {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: flashSuccess.content,
      timer: 2000,
      showConfirmButton: false
    });
  }
  if (flashError?.content) {
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: flashError.content,
      showConfirmButton: true
    });
  }

  // SweetAlert2 konfirmasi hapus (jika nanti ada tombol hapus)
  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    const form = $(this).closest('form');
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: 'Data tidak bisa dikembalikan!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal',
      customClass: {
        confirmButton: 'btn btn-danger me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-secondary waves-effect'
      },
      buttonsStyling: false
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Dibatalkan',
          text: 'Data tidak jadi dihapus.',
          icon: 'info',
          customClass: { confirmButton: 'btn btn-primary waves-effect' },
          buttonsStyling: false
        });
      }
    });
  });

  // Inisialisasi DataTables SPP
  const dt_table = $('.table-datatables-spp');
  if (dt_table.length) {
    const table = dt_table.DataTable({
      dom:
        '<"card-header flex-column flex-md-row border-bottom py-2 px-3"<"head-label"><"dt-action-buttons text-end pt-2 pt-md-0"B>>' +
        '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center"f>>' +
        't' +
        '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      responsive: true,
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      language: {
        paginate: {
          next: '<i class="ri-arrow-right-s-line"></i>',
          previous: '<i class="ri-arrow-left-s-line"></i>'
        }
      },
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
          text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
          buttons: [
            { extend: 'print', text: '<i class="ri-printer-line me-1"></i>Print', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4,5] } },
            { extend: 'csv', text: '<i class="ri-file-text-line me-1"></i>Csv', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4,5] } },
            { extend: 'excel', text: '<i class="ri-file-excel-line me-1"></i>Excel', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4,5] } },
            { extend: 'pdf', text: '<i class="ri-file-pdf-line me-1"></i>Pdf', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4,5] } },
            { extend: 'copy', text: '<i class="ri-file-copy-line me-1"></i>Copy', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4,5] } }
          ]
        }
      ]
    });

    table.on('draw', function () {
      const body = $(table.table().body());
      body.unhighlight();
      if (table.search()) {
        body.highlight(table.search());
      }
    });
  }
});
