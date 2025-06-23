// Form Validation for Tambah & Edit Kepengurusan Page
'use strict';

(function () {
  window.Helpers.initCustomOptionCheck();

  const flatPickrMulai = document.querySelector('#mulai');
  const flatPickrAkhir = document.querySelector('#akhir');

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
    document.getElementById('formKepengurusanCreate') ||
    document.getElementById('formKepengurusanEdit');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      nama: {
        validators: {
          notEmpty: { message: 'Nama wajib diisi' }
        }
      },
      jabatan: {
        validators: {
          notEmpty: { message: 'Jabatan wajib diisi' }
        }
      },
      mulai: {
        validators: {
          notEmpty: { message: 'Tanggal mulai jabatan wajib diisi' },
          date: {
            format: 'YYYY-MM-DD',
            message: 'Format tanggal tidak valid'
          }
        }
      },
      akhir: {
        validators: {
          notEmpty: { message: 'Tanggal akhir jabatan wajib diisi' },
          date: {
            format: 'YYYY-MM-DD',
            message: 'Format tanggal tidak valid'
          }
        }
      },
      foto: {
        validators: {
          file: {
            extension: 'jpg,jpeg,png',
            type: 'image/jpeg,image/png',
            message: 'File harus berupa gambar (jpg, jpeg, png)'
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
