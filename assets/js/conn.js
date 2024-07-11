 // login modal
 const openModalButton = document.getElementById('openModal');
 const closeModalButton = document.getElementById('closeModal');
 const modal = document.getElementById('modal');
 

 openModalButton.addEventListener('click', () => {
   modal.classList.remove('hidden');
})

 closeModalButton.addEventListener('click', () => {
    modal.classList.add('hidden');
 });

 window.addEventListener('click', (event) => {
    if(event.target === modal){
        modal.classList.add('hidden');
    }
 })
//  sign up modal
const openSignUpModal = document.getElementById('openSignUp');
const closeSignUpButton = document.getElementById('closeSignUp');
const modalSignUp = document.getElementById('modalSignUp');
 

openSignUpModal.addEventListener('click', () => {
   modalSignUp.classList.remove('hidden');
})

closeSignUpButton.addEventListener('click', () => {
   modalSignUp.classList.add('hidden');
 });

 window.addEventListener('click', (event) => {
    if(event.target === modalSignUp){
      modalSignUp.classList.add('hidden');
    }
 })



 

function openSignUp()  {
   modal.classList.add('hidden');
   openSignUpModal.classList.remove('hidden');


 };
function openSignIn(){
   openSignUpModal.classList.add('hidden');
   modal.classList.remove('hidden');

 };


