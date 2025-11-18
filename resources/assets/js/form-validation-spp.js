'use strict';

document.addEventListener('DOMContentLoaded', function () {
  // Ambil form SPP
  const formEl = document.querySelector('.needs-validation');
  if (!formEl) return;

  // Inisialisasi validasi form menggunakan FormValidation
  const fv = FormValidation.formValidation(formEl, {
    fields: {
      status: {
        validators: {
          notEmpty: {
            message: 'Status wajib dipilih'
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
});
