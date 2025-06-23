// Form Validation for Tambah & Edit Donatur Page
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

  const formEl = document.getElementById('formDonaturCreate') || document.getElementById('formDonaturEdit');
  if (!formEl) return;

  const isEdit = formEl.id === 'formDonaturEdit';

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      username: {
        validators: {
          notEmpty: { message: 'Username wajib diisi' },
          stringLength: {
            min: 4,
            max: 20,
            message: 'Panjang username 4-20 karakter'
          }
        }
      },
      password: {
        validators: isEdit
          ? {
              callback: {
                message: 'Boleh kosong atau minimal 6 karakter',
                callback: function (input) {
                  return input.value.length === 0 || input.value.length >= 6;
                }
              }
            }
          : {
              notEmpty: { message: 'Password wajib diisi' },
              stringLength: {
                min: 6,
                message: 'Password minimal 6 karakter'
              }
            }
      },
      password_confirmation: {
        validators: {
          identical: {
            compare: function () {
              return formEl.querySelector('[name="password"]').value;
            },
            message: 'Password tidak cocok'
          }
        }
      },
      nama: {
        validators: {
          notEmpty: { message: 'Nama wajib diisi' }
        }
      },
      alamat: {
        validators: {
          notEmpty: { message: 'Alamat wajib diisi' },
          stringLength: {
            max: 255,
            message: 'Alamat maksimal 255 karakter'
          }
        }
      },
      no_telepon: {
        validators: {
          stringLength: {
            max: 20,
            message: 'No telepon maksimal 20 karakter'
          }
        }
      },
      email: {
        validators: {
          emailAddress: {
            message: 'Masukkan format email yang valid'
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
