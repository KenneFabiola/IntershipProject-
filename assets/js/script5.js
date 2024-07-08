const sectionButton = document.getElementById('sectionButton');
const modalSectionClose = document.getElementById('modalSectionClose');
const sectionModal = document.getElementById('sectionModal');
const cover = document.getElementById('cover');

 

sectionButton.addEventListener('click', () => {
  
   sectionModal.classList.remove('hidden');
})

modalSectionClose.addEventListener('click', () => {
   sectionModal.classList.add('hidden');
 });
cover.addEventListener('click', () => {
   sectionModal.classList.add('hidden');
 });

 window.addEventListener('click', (event) => {
    if(event.target === sectionModal){
      sectionModal.classList.add('hidden');
    }
 });









 
