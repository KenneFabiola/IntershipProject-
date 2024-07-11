
 // modal to add user

 const openAddModal = document.getElementById('openAddModal');
 const closeModalAddButton = document.getElementById('closeAddModal');
 const addUserModal = document.getElementById('addUserModal');

  
 
 openAddModal.addEventListener('click', () => {
   
    addUserModal.classList.remove('hidden');
 })
 
 closeModalAddButton.addEventListener('click', () => {
    addUserModal.classList.add('hidden');
  });
 
  window.addEventListener('click', (event) => {
     if(event.target === addUserModal){
       addUserModal.classList.add('hidden');
     }
  });

// update user;

  function openEditModal(button) {
   const userId = button.getAttribute('data-user');
   const username = button.getAttribute('data-username');
   const firstname = button.getAttribute('data-firstname');
   const lastname = button.getAttribute('data-lastname');
   const email = button.getAttribute('data-email');
   
   // alert ();
   // document.getElementById('refId').innerHTML = userId ;
   document.getElementById('updateById').value = userId ;
   document.getElementById('updateUsername').value =username ;
   document.getElementById('updateFirstname').value =firstname ;
   document.getElementById('updateLastname').value =lastname ;
   document.getElementById('updateEmail').value =email ;
 

   
document.getElementById('editModal').classList.remove('hidden');


}

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



  







  


 