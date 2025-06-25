'use strict';

(function () {
  // Inisialisasi helper checkbox dan select2
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

  // Validasi native Bootstrap
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

  // Validasi khusus menggunakan FormValidation.js
  const formEl = document.querySelector('#formNilaiEdit');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      nilai: {
        validators: {
          notEmpty: {
            message: 'Nilai tidak boleh kosong'
          },
          numeric: {
            message: 'Nilai harus berupa angka'
          },
          between: {
            min: 0,
            max: 100,
            message: 'Nilai harus antara 0 - 100'
          }
        }
      },
      tahun_ajaran: {
        validators: {
          notEmpty: {
            message: 'Tahun ajaran tidak boleh kosong'
          },
          stringLength: {
            min: 4,
            max: 9,
            message: 'Tahun ajaran tidak valid'
          },
          regexp: {
            regexp: /^[0-9]{4}\/[0-9]{4}$/,
            message: 'Format tahun ajaran harus seperti 2024/2025'
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
