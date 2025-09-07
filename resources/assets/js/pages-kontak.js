'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const formKontak = document.getElementById('formKontak');

  // Validasi FormValidation.js
  if (formKontak) {
    FormValidation.formValidation(formKontak, {
      fields: {
        tiktok: {
          validators: {
            uri: {
              message: 'URL TikTok tidak valid'
            }
          }
        },
        facebook: {
          validators: {
            uri: {
              message: 'URL Facebook tidak valid'
            }
          }
        },
        instagram: {
          validators: {
            uri: {
              message: 'URL Instagram tidak valid'
            }
          }
        },
        whatsapp: {
          validators: {
            regexp: {
              regexp: /^[0-9]+$/,
              message: 'Nomor WhatsApp hanya boleh angka'
            }
          }
        },
        email: {
          validators: {
            emailAddress: {
              message: 'Format email tidak valid'
            }
          }
        },
        youtube: {
          validators: {
            uri: {
              message: 'URL YouTube tidak valid'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          rowSelector: '.form-floating-outline'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      }
    });
  }

  // SweetAlert flash success & error
  const flashSuccess = document.querySelector('meta[name="flash-success"]');
  const flashError = document.querySelector('meta[name="flash-error"]');

  if (flashSuccess && flashSuccess.content) {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: flashSuccess.content,
      timer: 2000,
      showConfirmButton: false,
      customClass: { confirmButton: 'btn btn-primary' },
      buttonsStyling: false
    });
  }

  if (flashError && flashError.content) {
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: flashError.content,
      customClass: { confirmButton: 'btn btn-danger' },
      buttonsStyling: false
    });
  }
});
