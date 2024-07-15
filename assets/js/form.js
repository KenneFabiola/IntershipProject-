function openAddNewProgram() {

    document.getElementById('addProgramModal').classList.remove('hidden');
}

function closeAddProgram() {
    document.getElementById('addProgramModal').classList.add('hidden');

}


/* modal to delete program */
function openDeleteProgram(button) {
    const programId = button.getAttribute('data-programdelete_id'); 
   
    document.getElementById('refProgramId').innerHTML = programId;
    document.getElementById('deleteProgramById').value = programId;
  
    document.getElementById('deleteProgram').classList.remove('hidden');
  }
  
  // function to close modal 
  
  function closeDeleteProgram() {

    document.getElementById('deleteProgram').classList.add('hidden');
    
     }

 document.getElementById('addProgram').addEventListener('submit', function(e) {
    e.preventDefault();
    const nom = document.getElementById('addProgramName').value;
    const level = document.getElementById('addLevelName').value;
    const description = document.getElementById('addDescribe').value;
    const duration = document.getElementById('addDuration').value;
    const messageError = document.getElementById('error');
    /* request regex for regular expression */
    const nomRegex = /^[A-Za-z]+$/;
    const levelRegex = /^(niveau-|NIVEAU-)[1-5]$/;
    const descriptionRegex = /^[A-Za-z' ]+$/;
    const durationRegex = /^[1-24][mois|MOIS]$/;
 
    if(nom == '' || level == '' || description == '' || duration == '') {
        messageError.textContent = " Veuillez remplir tout les champs";
      nominput.classList.remove('border','border-gray-300');
      nominput.classList.add('border','border-red-800');
        e.preventDefault();
    }else {
        if(!nomRegex.test(nom)) {
            document.getElementById('addProgramNameError').textContent = " UtiliserR uniquement des caracteres aplhanumérique";
            document.getElementById('addProgramNameError').classList.add('text-red-500');
            e.preventDefault();
        }else if(!levelRegex.test(level)) {
            document.getElementById('addLevelNameError').textContent = " Utiliser le format niveau-[1 a 5]; Ex: niveau-1 ou NIVEAU-1";
            document.getElementById('addLevelNameError').classList.add('text-red-500');

            e.preventDefault();
        }else if(!descriptionRegex.test(description)) {
            document.getElementById('addDescribeError').textContent = " Utiliser uniquement des caracteres aplhanumérique";
            document.getElementById('addDescribeError').classList.add('text-red-500');
            e.preventDefault();
        }else if(!durationRegex.test(duration)) {
            document.getElementById('addDurationError').textContent = " Utiliser le format [1 a 24]- mois; EX:12-mois ou 12-MOIS";
            document.getElementById('addDurationError').classList.add('text-red-500');

            e.preventDefault();
        }
    }

    
});
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('addProgram');
    const allInput =[
        {id:'addProgramName', type:'text'},
        {id:'addLevelName', type:'text'},
        {id:'addDescribe',type:'text'},
        {id:'addDuration',type:'text'}
          ];

          allInput.forEach(inputs => {
            const input = document.getElementById(inputs.id);
            input.addEventListener('input', function() {
                valideInput(input,inputs);
            });
          });

          function valideInput(input,inputs) {
            let errorMessage = '';
            // get form value
            const value = input.value.trim();
            const errorElement = document.getElementById(inputs.id +'Error');

            // test on type 
            if((inputs.type === 'text') &&(inputs.id === 'addProgramName') && (value.length<2) ) {
                errorMessage = 'caractere minimal: 2';
            }
            else if((inputs.type === 'text') &&(inputs.id === 'addProgramName') && (value.length> 5) ) {
                errorMessage = 'caractere max: 5';
            }
             if((inputs.type === 'text') && (inputs.id === 'addLevelName')  && (value.length != 8 )) {
                    errorMessage = 'le format a respecté doit être: niveau-7';
                }
            if((inputs.type === 'text') &&(inputs.id === 'addDescribe') && (value.length < 5)) {
                errorMessage = "Veuillez decrire le prgramme ";

            } else if((inputs.type === 'text') &&(inputs.id === 'addProgramName') && (value.length > 50)) {
                errorMessage = "Votre description est trop longue";

            }
            if((inputs.type === 'text') && (inputs.id === 'addDuration')  && (value.length < 6)) {
                errorMessage = 'la longueurs minimal est de 6, les formations sont définis en terme de mois';
            } else if((inputs.type === 'text') && (inputs.id === 'addDuration')  && (value.length >7)) {
                errorMessage = 'la longueurs maximal est de 7, les formations sont définis en terme de mois';

            }
             
           
            if(errorMessage) {
                input.classList.add('border-red-500');
                errorElement.classList.add('text-red-500');
                errorElement.textContent = errorMessage;
            }
            else {
                input.classList.remove('border-red-500');
                errorElement.classList.remove('text-red-500');
                errorElement.textContent = '';

            }
          }
});


