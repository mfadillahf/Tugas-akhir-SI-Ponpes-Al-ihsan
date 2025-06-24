'use strict';

(function () {
  window.Helpers.initCustomOptionCheck();

  const flatPickrTanggal = document.querySelector('#tanggal');
  if (flatPickrTanggal) {
    flatPickrTanggal.flatpickr({
      allowInput: true,
      dateFormat: 'Y-m-d'
    });
  }

  const selectKategori = $('#id_jenis_berita');
  if (selectKategori.length) {
    selectKategori.wrap('<div class="position-relative"></div>').select2({
      placeholder: '-- Pilih Jenis Berita --',
      dropdownParent: selectKategori.parent()
    });
  }

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

  const formEl = document.getElementById('formBeritaCreate') || document.getElementById('formBeritaEdit');
  if (!formEl) return;

  const isCreate = formEl.id === 'formBeritaCreate';

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      id_jenis_berita: {
        validators: {
          notEmpty: { message: 'Kategori berita wajib dipilih' }
        }
      },
      judul: {
        validators: {
          notEmpty: { message: 'Judul wajib diisi' },
          stringLength: {
            min: 5,
            message: 'Judul minimal 5 karakter'
          }
        }
      },
      isi: {
        validators: {
          notEmpty: { message: 'Isi berita wajib diisi' },
          stringLength: {
            min: 10,
            message: 'Isi berita minimal 10 karakter'
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
        validators: Object.assign(
          {},
          isCreate ? {
            notEmpty: {
              message: 'Foto wajib diunggah'
            }
          } : {},
          {
            file: {
              extension: 'jpg,jpeg,png',
              type: 'image/jpeg,image/png',
              message: 'File harus berupa gambar (jpg, jpeg, png)'
            }
          }
        )
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
})();
