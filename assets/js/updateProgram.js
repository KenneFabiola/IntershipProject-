
//  /* modal to update program */    

function openEditProgramModal(button) {

    const programUpdateId= button.getAttribute('data-program_id');
    const programUpdateName = button.getAttribute('data-program_name');
    const programUpdateLevel = button.getAttribute('data-level_name');
    const programUpdateDescription = button.getAttribute('data-program_description');
    const programUpdateDuration = button.getAttribute('data-duration');
  
    document.getElementById('updateProgramById').value = programUpdateId;
    document.getElementById('updateProgramName').value = programUpdateName;
    document.getElementById('updateLevelName').value = programUpdateLevel;
    document.getElementById('updateProgramDescription').value = programUpdateDescription;
    document.getElementById('updateProgramDuration').value = programUpdateDuration;
  
  
    document.getElementById('updateProgramModal').classList.remove('hidden');
  }
  
  function closeUpdateProgramModal() {
    document.getElementById('updateProgramModal').classList.add('hidden');
    
  }

  // treatment for update program
  document.getElementById('updateProgramModal').addEventListener('submit', function (e) {

 
const updateNom = document.getElementById('updateProgramName').value;
const updateLevel = document.getElementById('updateLevelName').value;
const updateDescription = document.getElementById('updateProgramDescription').value;
const updateDuration = document.getElementById('updateProgramDuration').value;
const messageError = document.getElementById('errorUpdate');
let isUpdateValid = true;

/* request regex for regular expression */
const  updatenomRegex = /^[A-Za-z]+$/;
const  updatelevelRegex = /^(niveau-|NIVEAU-)[1-5]$/;
const  updatedescriptionRegex = /^[A-Za-z' ]+$/;
const  updatedurationRegex = /^[1-9]|[1-2][0-9]-?(mois|MOIS)$/;

if (updateNom == '' || updateLevel == '' || updateDescription == '' || updateDuration == '') {
  messageError.textContent = " Veuilez remplir tout les champs";
  isUpdateValid = false;

}else {
  if(!updatenomRegex.test(updateNom)) {
    document.getElementById('updateProgramNameError').textContent = " Utiliser uniquement des caracteres aplhanumérique";
    document.getElementById('updateProgramNameError').classList.add('text-red-500');
    isUpdateValid = false;
  } else if(!updatelevelRegex.test(updateLevel)) {
    // alert();
    document.getElementById('updateLevelNameError').textContent = " Utiliser le format niveau-[1 a 5]; Ex: niveau-1 ou NIVEAU-1";
    document.getElementById('updateLevelNameError').classList.add('text-red-500');
    isUpdateValid = false;
  } else if(!updatedescriptionRegex.test(updateDescription)) {
    document.getElementById('updateProgramDescriptionError').textContent = " Utiliser uniquement des caracteres aplhanumérique";
    document.getElementById('updateProgramDescriptionError').classList.add('text-red-500');
    isUpdateValid = false;
  } else if(!updatedurationRegex.test(updateDuration)) {
    document.getElementById('updateProgramDurationError').textContent = " Utiliser le format [1 a 24]- mois; EX:12-mois ou 12-MOIS";
    document.getElementById('updateProgramDurationError').classList.add('text-red-500');
    isUpdateValid = false;
  }
}
if(!isUpdateValid) {
  e.preventDefault();
}


  });

  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('updateProgramModal');

  const tabInputs = [
    { id: 'updateProgramName', type: 'text'},
    { id: 'updateLevelName', type: 'text'},
    { id: 'updateProgramDescription', type: 'text'},
    { id: 'updateProgramDuration', type: 'text'}
 ];

 tabInputs.forEach(dataInput => {
  const tabInput = document.getElementById(dataInput.id);
  tabInput.addEventListener('input', function() {
    valideInputs(tabInput,dataInput);
  });
 });

 function valideInputs(tabInput, dataInput) {
  let errorUpdateMessage = '';
  const value = tabInput.value.trim();
  const errorElement = document.getElementById(dataInput.id + 'Error');

  if((dataInput.type === 'text') && (dataInput.id === 'updateProgramName') && (value.length < 2)) {
    // alert();
   
    errorUpdateMessage = 'caractere minimal: 2';

  } else if((dataInput.type === 'text') && (dataInput.id === 'updateProgramName') && (value.length > 5)) {
    errorUpdateMessage = 'caractere max: 5'; 

  } if((dataInput.type === 'text') && (dataInput.id === 'updateLevelName') && (value.length != 8)) {
    errorUpdateMessage = 'le format a respecté doit être: niveau-7';

 } if ((dataInput.type === 'text') && (dataInput.id === 'updateProgramDescription') && (value.length < 5)) {
  errorUpdateMessage = "Veuillez decrire le prgramme ";

} else if ((dataInput.type === 'text') && (dataInput.id === 'updateProgramDescription') && (value.length > 50)) {
  
  errorUpdateMessage = "Votre description est trop longue";

}
if ((dataInput.type === 'text') && (dataInput.id === 'updateProgramDuration') && (value.length < 6)) {
  errorUpdateMessage = 'la longueurs minimal est de 6, les formations sont définis en terme de mois';

} else if ((dataInput.type === 'text') && (dataInput.id === 'updateProgramDuration') && (value.length > 7)) {
  errorUpdateMessage = 'la longueurs maximal est de 7, les formations sont définis en terme de mois';

}

  if(errorUpdateMessage) {
    errorElement.classList.add('text-red-500');
    errorElement.textContent = errorUpdateMessage;
    e.preventDefault();
  } else {
    errorElement.classList.remove('text-red-500');
    errorElement.textContent = '';
  }

 }

 });