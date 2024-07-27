/* add section */

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



/* finish section */
function openFinishModal(button) {
    
    const sectionId = button.getAttribute('data_section_id');
    document.getElementById('refSectionId').innerHTML = sectionId;
    document.getElementById('finishSectionById').value = sectionId;
    document.getElementById('finishSection').classList.remove('hidden');

}

function closeSection() {
    document.getElementById('finishSection').classList.add('hidden');
}

/* menu deroulant section */

// menu deroulant de la section

function openMultiDropdown(button) {
    
    document.getElementById('optionForSection').classList.remove('hidden');
    
}



 function closeMultiDropdownS() {
   alert();
   //  document.getElementById('optionForSection').classList.add('hidden');

 }

/* menu deroulant de l'enregistrement */

