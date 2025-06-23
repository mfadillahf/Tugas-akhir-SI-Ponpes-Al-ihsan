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

  // Show Detail Modal Infaq
  $(document).on('click', 'button[data-bs-toggle="modal"]', function () {
    const infaqId = $(this).data('id');
    $.ajax({
      url: '/infaq/' + infaqId + '/detail',
      type: 'GET',
      success: function (response) {
        const modalContent = `
          <table class="table table-sm table-bordered">
            <tbody>
              <tr>
                <th>Nominal</th>
                <td>Rp ${parseInt(response.nominal).toLocaleString('id-ID')}</td>
              </tr>
              <tr>
                <th>Tanggal</th>
                <td>${response.tanggal}</td>
              </tr>
              <tr>
                <th>Keterangan</th>
                <td>${response.keterangan}</td>
              </tr>
            </tbody>
          </table>
        `;
        $('#modalBody').html(modalContent);
      },
      error: function () {
        $('#modalBody').html('<p class="text-danger">Gagal memuat detail infaq.</p>');
      }
    });
  });

  // Ambil role user dari meta tag
  const userRole = document.querySelector('meta[name="user-role"]')?.content;
  const isAdmin = userRole === 'admin';

  // Inisialisasi DataTables
  const dt_basic_table = $('.datatables-basic');
  if (dt_basic_table.length) {
    const table = dt_basic_table.DataTable({
      dom:
        '<"card-header flex-column flex-md-row border-bottom py-2 px-3"<"head-label">' +
        (isAdmin ? '<"dt-action-buttons text-end pt-2 pt-md-0"B>' : '') +
        '>' +
        '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center"f>>' +
        't' +
        '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
      },
      buttons: isAdmin
        ? [
            {
              extend: 'collection',
              className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
              text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
              buttons: [
                {
                  extend: 'print',
                  text: '<i class="ri-printer-line me-1"></i>Print',
                  className: 'dropdown-item',
                  exportOptions: { columns: [1, 2, 3, 4, 5] }
                },
                {
                  extend: 'csv',
                  text: '<i class="ri-file-text-line me-1"></i>Csv',
                  className: 'dropdown-item',
                  exportOptions: { columns: [1, 2, 3, 4, 5] }
                },
                {
                  extend: 'excel',
                  text: '<i class="ri-file-excel-line me-1"></i>Excel',
                  className: 'dropdown-item',
                  exportOptions: { columns: [1, 2, 3, 4, 5] }
                },
                {
                  extend: 'pdf',
                  text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                  className: 'dropdown-item',
                  exportOptions: { columns: [1, 2, 3, 4, 5] }
                },
                {
                  extend: 'copy',
                  text: '<i class="ri-file-copy-line me-1"></i>Copy',
                  className: 'dropdown-item',
                  exportOptions: { columns: [1, 2, 3, 4, 5] }
                }
              ]
            }
          ]
        : []
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
