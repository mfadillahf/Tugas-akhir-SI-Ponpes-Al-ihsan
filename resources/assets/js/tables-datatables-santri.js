'use strict';

let fv, offCanvasEl;
document.addEventListener('DOMContentLoaded', function () {
  // SweetAlert2: Notifikasi sukses/gagal dari session
  const flashSuccess = document.querySelector('meta[name="flash-success"]');
  const flashError = document.querySelector('meta[name="flash-error"]');
  if (flashSuccess?.content) {
    Swal.fire({ icon: 'success', title: 'Berhasil', text: flashSuccess.content, timer: 2000, showConfirmButton: false });
  }
  if (flashError?.content) {
    Swal.fire({ icon: 'error', title: 'Gagal', text: flashError.content, showConfirmButton: true });
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

  // Detail Santri via AJAX
  $(document).on('click', '[data-bs-target="#detailModal"]', function () {
    const santriId = $(this).data('id');
    $('#modalBody').html('<p class="text-center">Memuat...</p>');

    $.ajax({
      url: '/santri/' + santriId + '/detail',
      type: 'GET',
      success: function (response) {
      const jk = (response.jenis_kelamin || '').toString().toUpperCase();
      const jenisKelamin = jk === 'L' ? 'Laki-laki' : jk === 'P' ? 'Perempuan' : '-';
        const modalContent = `
          <table class="table table-sm table-bordered">
            <tbody>
              <tr><th>Nama Lengkap</th><td>${response.nama_lengkap}</td></tr>
              <tr><th>Email</th><td>${response.email ?? '-'}</td></tr>
              <tr><th>No Telepon</th><td>${response.no_telepon}</td></tr>
              <tr><th>Jenis Kelamin</th><td>${jenisKelamin}</td></tr>
              <tr><th>Status</th><td>${response.status}</td></tr>
              <tr><th>Alamat</th><td>${response.alamat}</td></tr>
              <tr><th>Tanggal Lahir</th><td>${response.tanggal_lahir}</td></tr>
              <tr><th>Nama Panggil</th><td>${response.nama_panggil}</td></tr>
              <tr><th>Pendidikan Asal</th><td>${response.pendidikan_asal}</td></tr>
              <tr><th>Nama Ayah</th><td>${response.nama_ayah}</td></tr>
              <tr><th>Pekerjaan Ayah</th><td>${response.pekerjaan_ayah}</td></tr>
              <tr><th>No HP Ayah</th><td>${response.no_hp_ayah}</td></tr>
              <tr><th>Nama Ibu</th><td>${response.nama_ibu}</td></tr>
              <tr><th>Pekerjaan Ibu</th><td>${response.pekerjaan_ibu}</td></tr>
              <tr><th>No HP Ibu</th><td>${response.no_hp_ibu}</td></tr>
              <tr><th>Kelas</th><td>${response.kelas}</td></tr>
            </tbody>
          </table>
        `;
        $('#modalBody').html(modalContent);
      },
      error: function () {
        $('#modalBody').html('<p class="text-danger">Gagal mengambil data detail santri.</p>');
      }
    });
  });

  // Inisialisasi DataTables
  const dt_basic_table = $('.datatables-basic');
  if (dt_basic_table.length) {
    const table = dt_basic_table.DataTable({
      dom:
        '<"card-header flex-column flex-md-row border-bottom py-2 px-3"<"head-label"><"dt-action-buttons text-end pt-2 pt-md-0"B>>' +
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
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
          text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
          buttons: [
            {
              extend: 'print',
              text: '<i class="ri-printer-line me-1"></i>Print',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5, 6] }
            },
            {
              extend: 'csv',
              text: '<i class="ri-file-text-line me-1"></i>Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5, 6] }
            },
            {
              extend: 'excel',
              text: '<i class="ri-file-excel-line me-1"></i>Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5, 6] }
            },
            {
              extend: 'pdf',
              text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5, 6] }
            },
            {
              extend: 'copy',
              text: '<i class="ri-file-copy-line me-1"></i>Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5, 6] }
            }
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
