function openDropdownR(button) {
    const sectionId = button.getAttribute('data-section_id');
    const dropdown = document.getElementById(`dropdownRegistration_${sectionId}`);
    dropdown.classList.remove('hidden');

  }
function closeDropdownRegistration(sectionId) {
  const dropdown = document.getElementById(`dropdownRegistration_${sectionId}`);
  dropdown.classList.add('hidden');
}

/* gestion du dropdown des frais par programme */
function openDropdownTuition(button) {
  const sectionIdT = button.getAttribute('data-section_idT');
  document.getElementById(`dropdownTuition_${sectionIdT}`).classList.toggle('hidden');
}

function closeDropdownTuition(sectionIdT) {
  const closeT = document.getElementById(`dropdownTuition_${sectionIdT}`);
  closeT.classList.add('hidden');
}

/* gestion dropdown payment */
  function openDropdownP(button) {
 
    const sectionIdFP = button.getAttribute('data-section_idPayment');
    document.getElementById(`dropdownPayment_${sectionIdFP}`).classList.remove('hidden');
  }

function closeDropdownPayment(sectionIdFP) {

const close = document.getElementById(`dropdownPayment_${sectionIdFP}`);
  close.classList.add('hidden');

}

// Fermeture du dropdown en cliquant à l'exterieur
document.addEventListener('click', function(event) {
  const dropdown = document.getElementById('dropdownPayment');
  const button = event.target.closest('[onclick="openDropdownP(event)"]'); // Trouve le bouton d'ouverture
 
  // Vérifie si le clic était à l'extérieur du dropdown et du bouton
  if (!dropdown.contains(event.target) && !button) {
      dropdown.classList.add('hidden'); 
  }
});


  /* session terminé */
function openDropdownRT(button) {
    const sectionId = button.getAttribute('data-section_id');
    const dropdown = document.getElementById(`dropdownRegistrationT_${sectionId}`);
    dropdown.classList.remove('hidden');
  }




//   add registration

function openNewRegistration(sectionId) {

    document.getElementById('registrationSectionId').value = sectionId;
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

  function getStudentUnRegistrationId() {
    const studentUnregister = document.getElementById('unRegisterStudentId');
    const selectUnregister = studentUnregister.options[studentUnregister.selectedIndex];
    const studentUnregisterId = selectUnregister.getAttribute('data-unRegisterStudentId');
    document.getElementById('unregisterStudentId').value = studentUnregisterId;
  }

  function getStudentRegistrationId() {
    const studentRegister = document.getElementById('studentRegistrationId');
    const selectRegister = studentRegister.options[studentRegister.selectedIndex];
    const studentRegisterId = selectRegister.getAttribute('data-studentRegistrationId');
    document.getElementById('registrationStudentId').value = studentRegisterId;
  }
function getProgramRegistrationId() {
  const programNameRegistration = document.getElementById('programRegistrationId');
  const selectRegistrationProgram = programNameRegistration.options[programNameRegistration.selectedIndex];
  const programRegistration = selectRegistrationProgram.getAttribute('data-programRegistrationId');

  document.getElementById('registrationProgramId').value = programRegistration;
}
/* update */
function openEditRegistration(button) {

  const idRegister = button.getAttribute('data-registration-id');
  const firstnameRegister = button.getAttribute('data-registerFirstname');
  const lastnameRegister = button.getAttribute('data-registerLastname');
  const programRegister = button.getAttribute('data-registerProgramName');
  const programId = button.getAttribute('data-registerProgramId');
  const studentId = button.getAttribute('data-registerStudentId');
  const sectionId = button.getAttribute('data-registerSectionId');
// alert(firstnameRegister);
  document.getElementById('REGID').value = idRegister;
  document.getElementById('registrationFirstname').value = firstnameRegister;
  document.getElementById('registrationLastname').value = lastnameRegister;
  document.getElementById('REG').value = programRegister;
  document.getElementById('changeProgramId').value = programId;
  document.getElementById('updateByStudentId').value = studentId;
  document.getElementById('sectionId').value = sectionId;
 
 
  document.getElementById('updateRegistration').classList.toggle('hidden');
}

function closeUpdateRegistration() {
  document.getElementById('updateRegistration').classList.toggle('hidden');

}

function getUpadteRegistrationId() {
  const changeProgram = document.getElementById('REG');
  const selectChangeProgram = changeProgram.options[changeProgram.selectedIndex];
  const changeId = selectChangeProgram.getAttribute('data-updateProgramRegistrationId');

  document.getElementById('changeProgramId').value = changeId;
}

/* change program */
function changeProgram(button) {

  var firstname = document.getElementById('registrationFirstname').value;
  var lastname = document.getElementById('registrationLastname').value;
  var studentId = document.getElementById('updateByStudentId').value;
  var sectionId = document.getElementById('sectionId').value;

  if(document.getElementById('updateRegistration').classList.toggle('hidden')) {
    document.getElementById('nRegistrationFirstname').value = firstname;
    document.getElementById('nRregistrationLastname').value = lastname;
    document.getElementById('newProgramForSTudent').value = studentId;
    document.getElementById('sectionIdForNewProgram').value = sectionId;
  
    document.getElementById('changeProgram').classList.toggle('hidden');


  }else {
    alert('erreur');
  }

}

function closeAddNewProgram() {
  document.getElementById('changeProgram').classList.toggle('hidden');

}
  