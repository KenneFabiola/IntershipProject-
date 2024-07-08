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
    if(event.target === addProgramModal){
      addStudentModal.classList.add('hidden');
    }
 })