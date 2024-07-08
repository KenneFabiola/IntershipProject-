
/* modal for program */

// add modal

const openAddModalProgram = document.getElementById('openAddModalProgram');
const closeModalProgram = document.getElementById('closeAddModalProgram');
const addProgramModal = document.getElementById('addProgramModal');

 

openAddModalProgram.addEventListener('click', () => {
  
   addProgramModal.classList.remove('hidden');
})

closeModalProgram.addEventListener('click', () => {
   addProgramModal.classList.add('hidden');
 });

 window.addEventListener('click', (event) => {
    if(event.target === addProgramModal){
      addProgramModal.classList.add('hidden');
    }
 })

// delete modal



