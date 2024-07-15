/* add new tuition */
    // modal for new tuition
     function openAddModalTuition(button) {
     
        const tuitionProgram = button.getAttribute('data-program_name');
        const tuitionLevel = button.getAttribute('data-program_level');
        const tuitionId = button.getAttribute('data-program_id');
        const sectionId = button.getAttribute('data-section-id');
    
        document.getElementById('programName').value = tuitionProgram;
        document.getElementById('levelName').value =  tuitionLevel;
        document.getElementById('programId').value = tuitionId;
        document.getElementById('sectionId').value = sectionId;
        document.getElementById('addTuitionModal').classList.remove('hidden');
    
     }
    
     function getSelectedSectionId() {
      const selectSection = document.getElementById('section');
      const selectedOption = selectSection.options[selectSection.selectedIndex];
      const sectionId = selectedOption.getAttribute('data-section-id');
      document.getElementById('sectionId').value = sectionId;
  }
 
  
    
     function closeTuition() {
       
        document.getElementById('addTuitionModal').classList.add('hidden');
     }
    
    
     // open tuition by section id
    
     function openTuitionBySection(button) {
    
     }

/* modal to update tuition */
     function openEditModalTuition(button) {
      // alert();
      const updateTuititionById = button.getAttribute('data-tuition_id');
      const updateTuititionByProgramId = button.getAttribute('data-programid_tuition');
      const updateTuitionByProgram = button.getAttribute('data-program_tuition');
      const updateTuitionByLevel = button.getAttribute('data-tuition_level');
      const updatetuitionAmount = button.getAttribute('data-tuition_amount');
      const updateTuitionSection = button.getAttribute('data-tuition_section');
      const updateTuitionSectionId = button.getAttribute('data-sectionid_tuition');
      alert(updateTuitionSectionId);
      // const updateTuitionSectionId = button.getAttribute('data-section_id');

      document.getElementById('updateById').value = updateTuititionById;
      document.getElementById('updateByProgramId').value = updateTuititionByProgramId;
      document.getElementById('updateTByProgram').value = updateTuitionByProgram;
      document.getElementById('updateTByLevel').value = updateTuitionByLevel;
      document.getElementById('updateTAmount').value = updatetuitionAmount;
      document.getElementById('updateTSection').value = updateTuitionSection;
      document.getElementById('updateSectionId').value = updateTuitionSectionId;
      // document.getElementById('updateSectionId').value = updateTuitionSectionId;

      document.getElementById('updateTuitionModal').classList.remove('hidden');
   }


   function updateSelectedSectionId() {
      const selectUpdate = document.getElementById('updateTSection');
      const selectedUpdateOption = selectUpdate.options[selectUpdate.selectedIndex];
      const updateSectionId = selectedUpdateOption.getAttribute('data-section-id');
      document.getElementById('updateSectionId').value = updateSectionId;
  }


function closeUpdate() {
   document.getElementById('updateTuitionModal').classList.add('hidden');

}

/* script to deleted tuition */

function openDeleteTuitionModal(button) {
   // alert();
   const tuitionId = button.getAttribute('data-tuition_id'); 
   document.getElementById('deleteTuitionById').value = tuitionId;
   // alert(tuitionId);


   document.getElementById('deleteTuitionModal').classList.remove('hidden');
}
function closeDeleteTuitionModal() {
   document.getElementById('deleteTuitionModal').classList.add('hidden');

}

 