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

  const formEl = document.querySelector('#formMapelCreate') || document.querySelector('#formMapelEdit');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      id_guru: {
        validators: {
          notEmpty: {
            message: 'Guru wajib dipilih'
          }
        }
      },
      mapel: {
        validators: {
          notEmpty: {
            message: 'Nama mapel wajib diisi'
          },
          stringLength: {
            min: 2,
            max: 100,
            message: 'Nama mapel harus antara 2 sampai 100 karakter'
          }
        }
      },
      deskripsi: {
        validators: {
          notEmpty: {
            message: 'Deskripsi wajib diisi'
          },
          stringLength: {
            min: 5,
            message: 'Deskripsi minimal 5 karakter'
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
