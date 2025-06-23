// Form Validation for Tambah & Edit Guru Page
'use strict';

(function () {
  window.Helpers.initCustomOptionCheck();

  const flatPickrTanggalLahir = document.querySelector('#tanggal_lahir');
  if (flatPickrTanggalLahir) {
    flatPickrTanggalLahir.flatpickr({
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

  const formEl = document.getElementById('formGuruCreate') || document.getElementById('formGuruEdit');
  if (!formEl) return;

  const isEdit = formEl.id === 'formGuruEdit';

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
          notEmpty: { message: 'Nama lengkap wajib diisi' }
        }
      },
      nip: {
        validators: {
          stringLength: {
            min: 0,
            max: 30,
            message: 'NIP maksimal 30 karakter'
          }
        }
      },
      email: {
        validators: {
          emailAddress: {
            message: 'Masukkan format email yang valid'
          }
        }
      },
      no_telepon: {
        validators: {
          stringLength: {
            min: 0,
            max: 20,
            message: 'No telepon maksimal 20 karakter'
          }
        }
      },
      tanggal_lahir: {
        validators: {
          notEmpty: { message: 'Tanggal lahir wajib diisi' },
          date: {
            format: 'YYYY-MM-DD',
            message: 'Format tanggal tidak valid'
          }
        }
      },
      jenis_kelamin: {
        validators: {
          notEmpty: { message: 'Jenis kelamin wajib dipilih' }
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
