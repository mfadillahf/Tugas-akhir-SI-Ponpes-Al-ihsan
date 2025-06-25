'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const formAuthentication = document.querySelector('#formAuthentication');

  if (formAuthentication) {
    FormValidation.formValidation(formAuthentication, {
      fields: {
        username: {
          validators: {
            notEmpty: {
              message: 'Silakan masukkan username'
            },
            stringLength: {
              min: 4,
              message: 'Username minimal 4 karakter'
            }
          }
        },
        password: {
          validators: {
            notEmpty: {
              message: 'Silakan masukkan password'
            },
            stringLength: {
              min: 6,
              message: 'Password minimal 6 karakter'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          rowSelector: '.mb-4'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    });
  }
});
