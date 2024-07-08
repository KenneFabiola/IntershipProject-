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

// onglet scholarité

function openAddTuition(button) {
    const sectionForTuition = button.getAttribute('data_section_id_tuition');
    
    document.getElementById('tuitionModal').classList.remove('hidden');
    document.getElementById('sectionIdForTuition').value= sectionForTuition;
    document.getElementById('refSectionId').innerHTML = sectionForTuition;
}
function closeTuition() {
    
    document.getElementById('tuitionModal').classList.add('hidden');

}