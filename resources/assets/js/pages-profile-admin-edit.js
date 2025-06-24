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
            message: 'Username minimal 3 karakter'
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
      }
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
