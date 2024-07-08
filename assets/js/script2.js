
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
  })



  


 