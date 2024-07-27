function openDropdownPT() {

    document.getElementById('dropdownPaymentT').classList.remove('hidden');
  }
  function openDropdownRT(button) {
    const sectionId = button.getAttribute('data-section_id');
    const dropdownT = document.getElementById(`dropdownRegistrationT_${sectionId}`);
    dropdownT.classList.remove('hidden');
  }