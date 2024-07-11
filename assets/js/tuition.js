// add tuition

// function openAddTuition() {
    
//     document.getElementById('tuitionModal').classList.remove('hidden');
// }

// function closeTuition() {
//     document.getElementById('tuitionModal').classList.add('hidden');
// }



function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    
     }
    // modal for new tuition
     function openEditModalTuition(button) {
     
        const tuitionProgram = button.getAttribute('data-program_name');
        const tuitionId = button.getAttribute('data-program_id');
        const sectionId = button.getAttribute('data-section-id');
    
        document.getElementById('programName').value = tuitionProgram;
        document.getElementById('programId').value = tuitionId;
        document.getElementById('sectionId').value = sectionId;
        document.getElementById('addTuitionModal').classList.remove('hidden');
    
     }
    
     function getSelectedSectionId() {
        const selectSection = document.getElementById('section');
        const selectedId = selectSection.options[selectSection.selectedIndex].getAttribute('data-section-id');
        document.getElementById('section_id').value = selectedId;
    }
    
     function cover() {
        alert();
        document.getElementById('addTuitionModal').classList.add('hidden');
     }
    
    
     // open tuition by section id
    
     function openTuitionBySection(button) {
    
     }