'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const previewImage = document.querySelector('#previewTentangImg');
  const inputFile = document.querySelector('#gambar');
  const resetBtn = document.querySelector('.reset-image-btn');
  const formTentang = document.getElementById('formTentang');

  // Preview gambar + validasi manual
  if (previewImage && inputFile) {
    const originalSrc = previewImage.src;

    inputFile.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        const maxSize = 2 * 1024 * 1024;

        if (!allowedTypes.includes(file.type)) {
          Swal.fire({
            icon: 'error',
            title: 'Format tidak didukung',
            text: 'Hanya JPG, JPEG, atau PNG yang diperbolehkan.',
            customClass: { confirmButton: 'btn btn-danger' },
            buttonsStyling: false
          });
          inputFile.value = '';
          return;
        }

        if (file.size > maxSize) {
          Swal.fire({
            icon: 'error',
            title: 'Ukuran terlalu besar',
            text: 'Ukuran maksimal 2MB.',
            customClass: { confirmButton: 'btn btn-danger' },
            buttonsStyling: false
          });
          inputFile.value = '';
          return;
        }

        previewImage.src = URL.createObjectURL(file);
      }
    });

    if (resetBtn) {
      resetBtn.addEventListener('click', function () {
        inputFile.value = '';
        previewImage.src = originalSrc;
      });
    }
  }

  // Validasi FormValidation.js
  if (formTentang) {
    const isEditMode = formTentang.dataset.mode === 'edit';

    FormValidation.formValidation(formTentang, {
      fields: {
        judul: {
          validators: {
            notEmpty: {
              message: 'Judul wajib diisi'
            },
            stringLength: {
              min: 3,
              message: 'Judul minimal 3 karakter'
            }
          }
        },
        deskripsi: {
          validators: {
            notEmpty: {
              message: 'Deskripsi wajib diisi'
            },
            stringLength: {
              min: 5,
              message: 'Deskripsi minimal 5 karakter'
            }
          }
        },
        gambar: {
          validators: {
            notEmpty: {
              enabled: !isEditMode,
              message: 'Gambar wajib diunggah'
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
          rowSelector: '.form-floating-outline'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      }
    });
  }

  // SweetAlert flash
  const flashSuccess = document.querySelector('meta[name="flash-success"]');
  const flashError = document.querySelector('meta[name="flash-error"]');

  if (flashSuccess && flashSuccess.content) {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: flashSuccess.content,
      timer: 2000,
      showConfirmButton: false,
      customClass: {
        confirmButton: 'btn btn-primary'
      },
      buttonsStyling: false
    });
  }

  if (flashError && flashError.content) {
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: flashError.content,
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
  }
});
