
// Form Validation for Tambah & Edit Santri Page
'use strict';

(function () {
  window.Helpers.initCustomOptionCheck();

  const selectPicker = $('.selectpicker');
  if (selectPicker.length) {
    selectPicker.selectpicker();
  }

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

  const formEl = document.getElementById('formSantriCreate') || document.getElementById('formSantriEdit');
  if (!formEl) return;

  const isEdit = formEl.id === 'formSantriEdit';

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
      nama_lengkap: {
        validators: {
          notEmpty: { message: 'Nama lengkap wajib diisi' }
        }
      },
      nama_panggil: {
        validators: {
          notEmpty: { message: 'Nama panggil wajib diisi' }
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
      },
      pendidikan_asal: {
        validators: {
          notEmpty: { message: 'Pendidikan asal wajib diisi' }
        }
      },
      id_kelas: {
        validators: {
          notEmpty: { message: 'Kelas wajib dipilih' }
        }
      },
      status: {
        validators: {
          notEmpty: { message: 'Status wajib dipilih' }
        }
      },
      nama_ayah: {
        validators: {
          notEmpty: { message: 'Nama ayah wajib diisi' }
        }
      },
      no_hp_ayah: {
        validators: {
          notEmpty: { message: 'No HP ayah wajib diisi' }
        }
      },
      nama_ibu: {
        validators: {
          notEmpty: { message: 'Nama ibu wajib diisi' }
        }
      },
      no_hp_ibu: {
        validators: {
          notEmpty: { message: 'No HP ibu wajib diisi' }
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
