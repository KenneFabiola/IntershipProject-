// delete modal User

  function openDeleteModal(button) {
    const deleter = button.getAttribute('data-user');
    // alert ();
    document.getElementById('refId').innerHTML = deleter ;
    document.getElementById('deleteById').value = deleter ;

    
document.getElementById('deleteModal').classList.remove('hidden');


 }

 function closeDeleteModal() {
document.getElementById('deleteModal').classList.add('hidden');

 }



//  delete student

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


   



