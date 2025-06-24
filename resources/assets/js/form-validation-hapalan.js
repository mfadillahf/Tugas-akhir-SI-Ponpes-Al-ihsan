'use strict';

(function () {
  window.Helpers.initCustomOptionCheck();

  const select2 = $('.select2');
  if (select2.length) {
    select2.each(function () {
      const $this = $(this);
      $this.wrap('<div class="position-relative"></div>')
        .select2({
          dropdownParent: $this.parent()
        });
    });
  }

  const bsValidationForms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(bsValidationForms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });

  const formEl = document.querySelector('#formHapalanCreate');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      id_santri: {
        validators: {
          notEmpty: {
            message: 'Santri wajib dipilih'
          }
        }
      },
      id_kelas: {
        validators: {
          notEmpty: {
            message: 'Kelas wajib dipilih'
          }
        }
      },
      id_guru: {
        validators: {
          notEmpty: {
            message: 'Guru tidak ditemukan'
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
