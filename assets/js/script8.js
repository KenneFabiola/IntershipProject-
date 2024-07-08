/* modal to delete program */
function openProgram(button) {
    const programId = button.getAttribute('data_program_id'); 
    // alert ();
    document.getElementById('refProgramId').innerHTML = programId;
    document.getElementById('deleteProgramById').value = programId;
  
    document.getElementById('deleteProgram').classList.remove('hidden');
  }
  
  // function to close modal 
  
  function closeProgram() {
    document.getElementById('deleteProgram').classList.add('hidden');
    
     }

    
/* modal to update student */
function openEditStudentModal(button) {
    const studentId = button.getAttribute('data_student_id');
    const studentUsername = button.getAttribute('data_student_username');
    const studentFirstname = button.getAttribute('data_student_firstname');
    const studentLastname = button.getAttribute('data_student_last_name');
    const studentEmail = button.getAttribute('data_student_email');
    const studentProgram = button.getAttribute('data_student_program');
    const studentLastModified = button.getAttribute('data_student_last_modified_by_username');

    document.getElementById('updateStudentById').value = studentId;
    document.getElementById('updateStudentUsername').value = studentUsername;
    document.getElementById('updateStudentFirstname').value = studentFirstname;
    document.getElementById('updateStudentLastname').value = studentLastname;
    document.getElementById('updateStudentEmail').value = studentEmail;
    document.getElementById('updateStudentProgram').value = studentProgram;
    document.getElementById('usernameUser').value = studentLastModified;

    document.getElementById('editStudentModal').classList.remove('hidden');
}

function closeEditStudentModal() {
    document.getElementById('editStudentModal').classList.add('hidden');
    
}