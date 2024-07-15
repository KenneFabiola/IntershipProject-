
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

  function getSelectedRoleId() {
 
   const selectRole = document.getElementById('role');
   const selectedOption = selectRole.options[selectRole.selectedIndex];
   const roleId = selectedOption.getAttribute('data-role_id');
   document.getElementById('roleId').value = roleId;
}


// update user;

function openEditUserModal(button) {

   const userId = button.getAttribute('data-user');
   const username = button.getAttribute('data-username');
   const firstname = button.getAttribute('data-firstname');
   const lastname = button.getAttribute('data-lastname');
   const email = button.getAttribute('data-email');
   const roleId = button.getAttribute('data-roleId'); 

   
   // alert ();
   // document.getElementById('refId').innerHTML = userId ;
   document.getElementById('updateById').value = userId ;
   document.getElementById('updateUsername').value =username ;
   document.getElementById('updateFirstname').value =firstname ;
   document.getElementById('updateLastname').value =lastname ;
   document.getElementById('updateEmail').value =email ;
   document.getElementById('updateRoleId').value =roleId ;
 

   
document.getElementById('editModal').classList.remove('hidden');


}

function closeEditModal() {
   document.getElementById('editModal').classList.add('hidden');

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



  







  


 