/* add new student */
const openStudentModal = document.getElementById('openModalStudent');
const closeStudentProgram = document.getElementById('closeStudentModal');
const addStudentModal = document.getElementById('addStudentModal');



openStudentModal.addEventListener('click', () => {
  
   addStudentModal.classList.remove('hidden');
})

closeStudentProgram.addEventListener('click', () => {
   addStudentModal.classList.add('hidden');
 });

 window.addEventListener('click', (event) => {
    if(event.target === addStudentModal){
      addStudentModal.classList.add('hidden');
    }
 });

 
/* delete student */

function openStudent(button) {
   const studentId = button.getAttribute('data_student_id'); 
   // alert ();
   document.getElementById('refStudentId').innerHTML = studentId;
   document.getElementById('deleteStudentById').value = studentId;
 
   document.getElementById('deleteStudent').classList.remove('hidden');
 }
 
 // function to close modal 
 
 function closeStudent() {
   document.getElementById('deleteStudent').classList.add('hidden');
   
    }


    
/* modal to update student */
function openEditStudentModal(button) {
   const studentId = button.getAttribute('data_student_id');
   const studentUsername = button.getAttribute('data_student_username');
   const studentFirstname = button.getAttribute('data_student_firstname');
   const studentLastname = button.getAttribute('data_student_last_name');
   const studentEmail = button.getAttribute('data_student_email');
   const studentLastModified = button.getAttribute('data_student_last_modified_by_username');

   document.getElementById('updateStudentById').value = studentId;
   document.getElementById('updateStudentUsername').value = studentUsername;
   document.getElementById('updateStudentFirstname').value = studentFirstname;
   document.getElementById('updateStudentLastname').value = studentLastname;
   document.getElementById('updateStudentEmail').value = studentEmail;
   document.getElementById('usernameUser').value = studentLastModified;

   document.getElementById('editStudentModal').classList.remove('hidden');
}

function closeEditStudentModal() {
   document.getElementById('editStudentModal').classList.add('hidden');
   
}



