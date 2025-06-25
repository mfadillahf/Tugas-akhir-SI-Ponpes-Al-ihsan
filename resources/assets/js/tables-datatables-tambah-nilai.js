'use strict';
  // Inisialisasi Select2 untuk form filter
  $('.select2').each(function () {
    $(this).wrap('<div class="position-relative"></div>').select2({
      dropdownParent: $(this).parent()
    });
  });

  // Validasi input nilai agar tidak lebih dari 100
  const nilaiInputs = document.querySelectorAll('input[type="number"][name^="nilai"]');
  nilaiInputs.forEach(input => {
    input.addEventListener('input', function () {
      let value = parseInt(this.value, 10);
      if (value > 100) this.value = 100;
      else if (value < 0) this.value = 0;
    });
  });