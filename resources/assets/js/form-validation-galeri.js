'use strict';

document.addEventListener('DOMContentLoaded', function () {
  window.Helpers.initCustomOptionCheck();

  // Inisialisasi Flatpickr
  const flatPickrTanggal = document.querySelector('#tanggal');
  if (flatPickrTanggal) {
    flatPickrTanggal.flatpickr({
      allowInput: true,
      dateFormat: 'Y-m-d'
    });
  }

  // Inisialisasi Select2
  const selectKategori = $('#kategori_galeri_id');
  if (selectKategori.length) {
    selectKategori.wrap('<div class="position-relative"></div>').select2({
      placeholder: '-- Pilih Kategori --',
      dropdownParent: selectKategori.parent()
    });
  }

  // Validasi Bootstrap biasa
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

  // Validasi FormValidation.js
  const formEl = document.getElementById('formGaleriCreate') || document.getElementById('formGaleriEdit');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      kategori_galeri_id: {
        validators: {
          notEmpty: { message: 'Kategori wajib dipilih' }
        }
      },
      deskripsi: {
        validators: {
          notEmpty: { message: 'Deskripsi wajib diisi' },
          stringLength: {
            min: 5,
            message: 'Deskripsi minimal 5 karakter'
          }
        }
      },
      tanggal: {
        validators: {
          notEmpty: { message: 'Tanggal wajib diisi' },
          date: {
            format: 'YYYY-MM-DD',
            message: 'Format tanggal tidak valid'
          }
        }
      },
      foto: {
        validators: {
          notEmpty: {
            enabled: formEl.id === 'formGaleriCreate', // hanya wajib saat create
            message: 'Foto wajib diunggah'
          },
          file: {
            extension: 'jpg,jpeg,png',
            type: 'image/jpeg,image/png',
            message: 'File harus berupa gambar (jpg, jpeg, png)'
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
