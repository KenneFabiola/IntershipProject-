function openDropdownRegistration(button) {

    document.getElementById('optionForRegistration').classList.remove('hidden');

}

function openNewRegistration(button) {
  // alert();
  document.getElementById('addRegistration').classList.remove('hidden');

}
function closeAddRegistration() {
  document.getElementById('addRegistration').classList.add('hidden');

}

function getStudentRegistrationId() {
    const studentNameRegistration = document.getElementById('studentRegistrationId');
    const selectRegistrationStudent = studentNameRegistration.options[studentNameRegistration.selectedIndex];
    const studentRegistration =selectRegistrationStudent.getAttribute('data-studentRegistrationId');

    document.getElementById('registrationStudentId').value = studentRegistration;

  }

function getProgramRegistrationId() {
  const programNameRegistration = document.getElementById('programRegistrationId');
  const selectRegistrationProgram = programNameRegistration.options[programNameRegistration.selectedIndex];
  const programRegistration = selectRegistrationProgram.getAttribute('data-programRegistrationId');

  document.getElementById('registrationProgramId').value = programRegistration;
}

function getSectionRegistrationId() {
  const sectionNameRegistration = document.getElementById('sectionRegistrationId');
  // recuperer la valeur de l'option selectionné dans le select
  const selectRegistrationSection = sectionNameRegistration.options[sectionNameRegistration.selectedIndex];
  // recuperer la valeur de l'attribut data de l'option selectionné
  const sectionRegistration = selectRegistrationSection.getAttribute('data-sectionRegistrationId');

  document.getElementById('registrationSectionId').value = sectionRegistration;
}