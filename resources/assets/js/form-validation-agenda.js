// Form Validation for Tambah & Edit Agenda Page
'use strict';

(function () {
  window.Helpers.initCustomOptionCheck();

  const flatPickrMulai = document.querySelector('#tanggal_mulai');
  const flatPickrAkhir = document.querySelector('#tanggal_akhir');

  if (flatPickrMulai) {
    flatPickrMulai.flatpickr({
      allowInput: true,
      dateFormat: 'Y-m-d'
    });
  }

  if (flatPickrAkhir) {
    flatPickrAkhir.flatpickr({
      allowInput: true,
      dateFormat: 'Y-m-d'
    });
  }

  const bsValidationForms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(bsValidationForms).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      },
      false
    );
  });

  const formEl =
    document.getElementById('formAgendaCreate') ||
    document.getElementById('formAgendaEdit');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      id_jenis_agenda: {
        validators: {
          notEmpty: { message: 'Jenis agenda wajib dipilih' }
        }
      },
      judul: {
        validators: {
          notEmpty: { message: 'Judul agenda wajib diisi' }
        }
      },
      deskripsi: {
        validators: {
          notEmpty: { message: 'Deskripsi agenda wajib diisi' }
        }
      },
      tanggal_mulai: {
        validators: {
          notEmpty: { message: 'Tanggal mulai wajib diisi' },
          date: {
            format: 'YYYY-MM-DD',
            message: 'Format tanggal tidak valid'
          }
        }
      },
      tanggal_akhir: {
        validators: {
          notEmpty: { message: 'Tanggal akhir wajib diisi' },
          date: {
            format: 'YYYY-MM-DD',
            message: 'Format tanggal tidak valid'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: '',
        rowSelector: '.col-md-6, .col-12'
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  });
})();
