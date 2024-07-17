
/*  modal to add user */
 function openAddUser(button) {
    document.getElementById('addUserModal').classList.remove('hidden');
 }
 function closeAddUser() {
    document.getElementById('addUserModal').classList.add('hidden');

 }

  function getSelectedRoleId() {
 
   const selectRole = document.getElementById('role');
   const selectedOption = selectRole.options[selectRole.selectedIndex];
   const roleId = selectedOption.getAttribute('data-role_id');
   document.getElementById('roleId').value = roleId;
}


/*  update user; */

function openEditUserModal(button) {
// alert();
   const userId = button.getAttribute('data-user');
   const username = button.getAttribute('data-username');
   const firstname = button.getAttribute('data-firstname');
   const lastname = button.getAttribute('data-lastname');
   const email = button.getAttribute('data-email');
   const roleId = button.getAttribute('data-roleId'); 
   const roleName = button.getAttribute('data-roleName');

   document.getElementById('updateById').value = userId ;
   document.getElementById('updateUsername').value =username ;
   document.getElementById('updateFirstname').value =firstname ;
   document.getElementById('updateLastname').value =lastname ;
   document.getElementById('updateEmail').value =email ;
   document.getElementById('updateRoleId').value =roleId ;
   document.getElementById('updateRoleName').value = roleName ;


   
document.getElementById('editModal').classList.remove('hidden');


}


function getUpdateRoleId() {
 
    const selectUpdateRole = document.getElementById('updateRoleName');
    const selectedUpdateOption = selectUpdateRole.options[selectUpdateRole.selectedIndex];
    const updateRoleId = selectedUpdateOption.getAttribute('data-updateRoleId');
    // alert(updateRoleId);
    document.getElementById('updateRoleId').value = updateRoleId;
 }

 

function closeEditModal() {
   document.getElementById('editModal').classList.add('hidden');

}

 
/* delete modal User */ 

function openDeleteModal(button) {
   const deleter = button.getAttribute('data-deleteUser');
   const checkRole = button.getAttribute('data-check_role');
   // alert(checkRole);
   document.getElementById('refId').innerHTML = deleter ;
   document.getElementById('deleteById').value = deleter ;
   document.getElementById('checkRoleId').value = checkRole ;

   
document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
document.getElementById('deleteModal').classList.add('hidden');

}