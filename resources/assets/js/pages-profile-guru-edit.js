'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const formEl = document.getElementById('formAccountSettings');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      username: {
        validators: {
          notEmpty: {
            message: 'Username wajib diisi'
          },
          stringLength: {
            min: 3,
            max: 50,
            message: 'Username harus 3-50 karakter'
          }
        }
      },
      password: {
        validators: {
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
            message: 'Konfirmasi password harus sama dengan password'
          }
        }
      },
      nama: {
        validators: {
          notEmpty: {
            message: 'Nama wajib diisi'
          },
          stringLength: {
            max: 50,
            message: 'Nama maksimal 50 karakter'
          }
        }
      },
      no_telepon: {
        validators: {
          notEmpty: {
            message: 'No Telepon wajib diisi'
          },
          stringLength: {
            max: 14,
            message: 'No Telepon maksimal 14 karakter'
          },
          regexp: {
            regexp: /^[0-9+\s()-]+$/,
            message: 'Format No Telepon tidak valid'
          }
        }
      },
      email: {
        validators: {
          emailAddress: {
            message: 'Format email tidak valid'
          },
          stringLength: {
            max: 50,
            message: 'Email maksimal 50 karakter'
          }
        }
      },
      nip: {
        validators: {
          notEmpty: {
            message: 'NIP wajib diisi'
          },
          stringLength: {
            max: 30,
            message: 'NIP maksimal 30 karakter'
          }
        }
      },
      tanggal_lahir: {
        validators: {
          notEmpty: {
            message: 'Tanggal lahir wajib diisi'
          },
          date: {
            format: 'YYYY-MM-DD',
            message: 'Format tanggal tidak valid (YYYY-MM-DD)'
          }
        }
      },
      jenis_kelamin: {
        validators: {
          notEmpty: {
            message: 'Jenis kelamin wajib dipilih'
          }
        }
      },
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: '',
        rowSelector: '.col-md-6, .col-md-12, .col-12'
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  });
});
