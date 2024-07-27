/* add user account */

 
function openAccount(button) {
    const accountStudentId = button.getAttribute('data-student_id');
    const accountUsername = button.getAttribute('data-student_username');
    const accountFirstname = button.getAttribute('data-student_firstname');
    const accountLastName = button.getAttribute('data-student_last_name');
    const accountEmail = button.getAttribute('data-student_email');
   
   //  alert(accountUsername);
    
    document.getElementById('studentId').value = accountStudentId;
    document.getElementById('usernameAccount').value = accountUsername;
    document.getElementById('firstNameAccount').value = accountFirstname;
    document.getElementById('lastNameAccount').value = accountLastName ;
    document.getElementById('emailAccount').value = accountEmail ;
 
 document.getElementById('studentAccount').classList.remove('hidden');
 
 }
 
 function getAccountRole() {
//   alert();
    const selectAccountRole = document.getElementById('accountRole');
    const selectedAccountOption = selectAccountRole.options[selectAccountRole.selectedIndex];
    const accountRoleId = selectedAccountOption.getAttribute('data-accountRoleId');
    // alert(accountRoleId);
    document.getElementById('accountRoleId').value = accountRoleId;
 }
 
 function closeButton() {
    document.getElementById('studentAccount').classList.add('hidden');
 }



 function disableStudent(button) {
const disableId = button.getAttribute('data-studentIdDisable');
const disableName = button.getAttribute('data-studentNameDisable');
alert(disableName);
document.getElementById('studentIdDisable').value = disableId ;
document.getElementById('disableName').value = disableName ;


   document.getElementById('disableStudent').classList.remove('hidden');
   
 }

 function  closeDisableStudent() {
   document.getElementById('disableStudent').classList.add('hidden');

 }