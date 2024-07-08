function openEditModal(button) {
    const userId = button.getAttribute('data-user');
    const username = button.getAttribute('data-username');
    const firstname = button.getAttribute('data-firstname');
    const lastname = button.getAttribute('data-lastname');
    const email = button.getAttribute('data-email');
    const pwd = button.getAttribute('data-pwd');
    // alert ();
    // document.getElementById('refId').innerHTML = userId ;
    document.getElementById('updateById').value = userId ;
    document.getElementById('updateUsername').value =username ;
    document.getElementById('updateFirstname').value =firstname ;
    document.getElementById('updateLastname').value =lastname ;
    document.getElementById('updateEmail').value =email ;
    document.getElementById('updatePassword').value =pwd ;

    
document.getElementById('editModal').classList.remove('hidden');


 }

 function closeEditModal() {
document.getElementById('editModal').classList.add('hidden');

 }