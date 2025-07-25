'use strict';

let fv, offCanvasEl;

document.addEventListener('DOMContentLoaded', function () {
  // SweetAlert2: Notifikasi sukses/gagal dari session
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

  // SweetAlert2: Konfirmasi hapus data
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
          customClass: {
            confirmButton: 'btn btn-primary waves-effect'
          },
          buttonsStyling: false
        });
      }
    });
  });

  // Inisialisasi DataTables tanpa export button
  const dt_basic_table = $('.datatables-basic');
  if (dt_basic_table.length) {
    const table = dt_basic_table.DataTable({
      dom:
        '<"card-header flex-column flex-md-row border-bottom py-2 px-3"<"head-label">>',
      responsive: true,
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      columnDefs: [
        {
          targets: 0,
          orderable: false,
          className: 'dt-checkboxes-cell',
          checkboxes: {
            selectRow: true
          },
          render: function () {
            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
          }
        }
      ],
      select: {
        style: 'multi',
        selector: 'td:first-child'
      },
      language: {
        paginate: {
          next: '<i class="ri-arrow-right-s-line"></i>',
          previous: '<i class="ri-arrow-left-s-line"></i>'
        }
      }
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
