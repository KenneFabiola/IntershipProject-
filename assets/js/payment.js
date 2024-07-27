function openPayment(button) {
    const registrationId = button.getAttribute('data-payment-id');
    const firstnameRegistration = button.getAttribute('data-payment-firstname');
    const lastnameRegistration = button.getAttribute('data-payment-lastname');
    const programRegistration = button.getAttribute('data-payment-program');
    const levelNameRegistration = button.getAttribute('data-payment-levelname');
    // alert(levelNameRegistration);

    document.getElementById('registrationId').value = registrationId;
    document.getElementById('firstname').value = firstnameRegistration;
    document.getElementById('usernameRegistration').value = firstnameRegistration;
    document.getElementById('lastname').value = lastnameRegistration;
    document.getElementById('program_name').value = programRegistration;
    document.getElementById('level_name').value = levelNameRegistration;
    document.getElementById('addPayment').classList.toggle('hidden');
}

function closeAddPModal() {
    document.getElementById('addPayment').classList.toggle('hidden');

}

function addPayment(button) {
    alert();
    const registrationIdForP = button.getAttribute('data-registrationIdForP');
    const firstnameForP = button.getAttribute('data-firstnameForP');
    const lastnameForP = button.getAttribute('data-lastnameForP');
    const programForP = button.getAttribute('data-programNameForP');
    const levelForP = button.getAttribute('data-levelNameForP');
    // alert(registrationIdForP);

    document.getElementById('registrationId').value = registrationIdForP;
    document.getElementById('firstname').value = firstnameForP;
    document.getElementById('lastname').value = lastnameForP;
    document.getElementById('program_name').value = programForP;
    document.getElementById('level_name').value = levelForP;

    document.getElementById('addPayment').classList.toggle('hidden');


}

//  update the last payment

function openEditPayment(button) {
    const paymentId = button.getAttribute('data-paymentId');
    const idRegistration = button.getAttribute('data-registrationId');
    const lastAmount = button.getAttribute('data-lastAmount');
    const firstNameP = button.getAttribute('data-firstNameP');
    const lastNameP = button.getAttribute('data-lastNameP');


    document.getElementById('paymentId').value = paymentId;
    document.getElementById('idRegistration').value = idRegistration;
    document.getElementById('lastAmount').value = lastAmount;
    document.getElementById('firstNameP').value = firstNameP;
    document.getElementById('lastNameP').value = lastNameP;


    document.getElementById('updatePayment').classList.toggle('hidden');
}
function closeUpdatePModal() {
    document.getElementById('updatePayment').classList.toggle('hidden');

}

// dropdown for student payment

function openDropdownPaymentForStudent(button) {
    // alert();
    const registrationIdDropdown = button.getAttribute('data-registrationDropdown');
    const paymentDropdown = document.getElementById(`dropdownStudentPayment_${registrationIdDropdown}`);
    paymentDropdown.classList.toggle('hidden');
}

function closeDropdownStudentPayemnt(registrationIdDropdown) {
    const paymentDropdown = document.getElementById(`dropdownStudentPayment_${registrationIdDropdown}`);
    paymentDropdown.classList.toggle('hidden');
    
}