
/* update session */

function openUpdateSessionModal(button) {
    // alert();
    const updateSectionId = button.getAttribute('data-sectionId');
    const updateSchoolYear = button.getAttribute('data-updateSchoolYear');
    const updateMonth = button.getAttribute('data-updateMonth');

    document.getElementById('updateMonth').value = updateMonth;
    // alert(updateMonth);
    document.getElementById('updateSchoolYear').value = updateSchoolYear;
    document.getElementById('updateSessionById').value = updateSectionId;

    document.getElementById('updateSectionModal').classList.remove('hidden');

 }

 function closeUpdateSession() {
    document.getElementById('updateSectionModal').classList.add('hidden');

 }