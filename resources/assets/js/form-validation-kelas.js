// Form Validation for Tambah & Edit Kelas Page
'use strict';

(function () {
  window.Helpers.initCustomOptionCheck();

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
    document.getElementById('formKelasCreate') ||
    document.getElementById('formKelasEdit');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      nama_kelas: {
        validators: {
          notEmpty: {
            message: 'Nama kelas wajib diisi'
          },
          stringLength: {
            min: 2,
            max: 100,
            message: 'Nama kelas minimal 2 dan maksimal 100 karakter'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: '',
        rowSelector: '.col-md-6, .col-12, .col-md-12'
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  });
})();
